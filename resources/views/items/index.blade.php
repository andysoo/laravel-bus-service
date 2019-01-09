@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10" >
            <h3 style="padding:.5rem .5rem 0">最近修理记录</h3>
        </div>
        <div class="col-md-1">
            <a href="{{url('items/create')}}" class="btn btn-primary" style="margin:.5rem .5rem 0;float:right">新增</a>
        </div>
        <div class="col-md-1">
            <a href="{{url('search')}}" class="btn btn-primary" style="margin:.5rem .5rem 0;float:right">查询</a>
        </div>
    </div>
    <div class="row justify-content-center">
            @foreach ($items as $item)            
        <div class="col-md-4">
            <div class="card" style="margin:10px">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            车牌：{{$item->bus['plate-number']}}
                        </div>
                        <div class="text-right col">
                            线路：{{$item->bus->line}}
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col">
                            材料费：{{$item['data-price']}}
                        </div>
                        <div class="text-right col">
                            工时费：{{$item['time-price']}}
                        </div>                        
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        修理项目：
                    </div>
                    <div >
                        {{$item->body}}
                    </div>
                    <div class="text-right">
                       <br/>修理时间：{{substr($item->mend_at,0,10)}}
                    </div>
                    
                    <div class="btn-group" style="float:right">
                        <a class="btn btn-info" href="{{url("items/$item->id/edit")}}">修改</a>
                       <form action="{{route('items.destroy',$item->id)}}" method="POST" >
                          @csrf
                          {{ method_field('DELETE') }}
                          <button class="btn btn-danger" onclick="if(!confirm('确定要删除吗?')) return false">删除</button>
                        </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
            @endforeach
    </div>
    <div class="row justify-content-center">
        {{$items->onEachSide(1)->links()}} 
    </div>
            
</div>
@endsection
