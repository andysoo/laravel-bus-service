<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Http\Requests\ItemCreateRequest;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //取用户车辆
        $myBusesId = Bus::where('user_id', Auth::id())->pluck('id')->toArray();

        //取所有车辆的记录并分页
        $items = Item::whereIn('bus_id', $myBusesId)->latest('mend_at', 'desc')->Paginate(21);

        return view('items.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //跳到表单页面
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemCreateRequest $request)
    {
        //验证表单(ItemCreateRequest类验证)后提交到数据库

        $bus            = Bus::where('plate-number', $request['plate-number'])->first();
        $data           = $request->all();
        $data['bus_id'] = $bus->id;
        $item           = Item::create($data);

        return redirect('items');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //返回一个修理记录的详情----所有详情已在index中
        $item = Item::find($id);
        return view('items.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //返回一个有数据的表单视图
        // $item['mend_at'] = Carbon::parse($item['mend_at'])->toDateString();

        return view('items.edit', ['item' => $item]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemCreateRequest $request, $id)
    {
        //更新记录 重定向到index

        $item = Item::find($id)->update($request->all());

        return redirect("items/{$id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect('items');
    }

    public function search()
    {
        //返回一个查询的表单视图

        // $line 按线路查询
        $lines = Bus::where('user_id', Auth::id())->groupBy('line')->pluck('line');

        // $busPlateNumber 按车牌号查询
        $busPlateNumber = Bus::where('user_id', Auth::id())->pluck('plate-number');

        return view('items.search', compact('lines', 'busPlateNumber'));
    }

    public function line(Request $request, $var)
    {
        //接受请求，查询数据库，返回index视图

        //手动查询到的数据
        $buses = Bus::where('user_id', Auth::id())->where('line', $var)->get();
        $data  = $buses->map(function ($bus) {
            foreach ($bus->item as $item) {
                $item['plate-number'] = $bus['plate-number'];
                $item['line']         = $bus->line;
            };
            return $bus->item;
        })->flatten(1);

        $items = $this->page($request, $data, $var);

        return view('items.result', compact('items', 'var'));
    }

    public function plateNumber(Request $request, $var)
    {
        //按车牌号查询所有维修记录
        $bus  = Bus::where('user_id', Auth::id())->get()->firstwhere('plate-number', $var);
        $data = $bus->item;
        foreach ($data as $item) {
            $item['plate-number'] = $bus['plate-number'];
            $item['line']         = $bus->line;
        }

        $items = $this->page($request, $data, $var);
        return view('items.result', compact('items'));
    }

    public function like(Request $request)
    {
        //查出表中所有符合模糊条件的项目
        $items = Item::where('body', 'like', '%' . $request->body . '%')->get();

        //过滤掉不是当前用户车辆的项目
        $userAllItems = $request->user()->bus->map(function ($bus) {
            return $bus->item;
        })->flatten(1);

        $likeItems = $items->intersect($userAllItems);

        $likeItems->map(function ($item) {
            $item['plate-number'] = $item->bus['plate-number'];
            $item['line']         = $item->bus->line;
            return $item;
        });

        $items = $this->page($request, $likeItems, "like?body=$request->body");
        return view('items.result', compact('items'));
    }

    /* 手动分页
     *  @request 请求实例
     *  @data (collection) 要分页的数据
     *  @var 分页路径
     *  @perPage 每页多少
     */

    protected function page($request, $data, $var = null, $perPage = 6)
    {
        //每个页面，数据显示的条数

        if ($request->has('page')) {
            $current_page = $request->input('page');
            $current_page = $current_page <= 0 ? 1 : $current_page;
        } else {
            $current_page = 1;
        }
        $offset = ($current_page - 1) * $perPage; //偏移量
        //手动查询到的数据

        $total = $data->count(); //所有符合条件的数据总数量
        $data  = $data->sortBy('mend_at')->reverse()->values()->toArray(); //需要按修理日期重新排序

        $itemPage = array_slice($data, $offset, $perPage);

        $items = new LengthAwarePaginator($itemPage, $total, $perPage);

        $items->withPath($var);

        return $items;
    }
}
