@extends('layouts.app')
@section('content')
  <div class="container">
    <h3 class="text-success text-center" style="padding:1rem">更新成功</h3>
        
    <div class="row justify-content-center">
                     
        <div class="col-md-8">
            <div class="card">
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
                        <a class="btn btn-info" href="{{url("items.edit",$item->id)}}">修改</a>
                       
                        <form action="{{route('items.destroy',$item->id)}}" method="POST" >
                          @csrf
                          {{ method_field('DELETE') }}
                          <button class="btn btn-danger" onclick="if(!confirm('确定要删除吗?')) return false">删除</button>
                        </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
            
    </div>
  </div>
@endsection