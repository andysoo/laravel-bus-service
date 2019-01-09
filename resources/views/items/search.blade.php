@extends('layouts.app')
@section('content')
  <div class="container">
    <h3 class="text-success text-center">选择查询方式</h3>
      <div class="row justify-content-center">
        
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
                模糊查询                
            </div>

            <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif              

              <form action="{{route('result.like')}}" method="GET">                
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="维修项目关键字模糊查询" name="body">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary">
                      <span class="oi oi-magnifying-glass"></span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
                按线路查询                
            </div>

              <div class="card-body text-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach ($lines as $line)
                  <a href="{{url("result/line/$line")}}" style="padding:.5rem">{{$line}}</a>
                @endforeach              
              </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
                按车牌查询                
            </div>

            <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif              

              @foreach ($busPlateNumber as $plateNumber)
                  <a href="{{url("result/plateNumber/$plateNumber")}}" style="padding:.5rem">{{$plateNumber}}</a>
              @endforeach
            </div>
          </div>
        </div>

        
      </div>
  </div>
    
@endsection