@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header justify-content-center">
        <h3>新增一条维修记录</h3>
      </div>
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class="card-body">
        <form action="{{url('items')}}" method="POST">
          @csrf
          <div class="form-group row">
            <label for="plate-number" class="col-sm-2 col-form-label">车牌号</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="plate-number" id="plate-number">
            </div>
          </div>

          <div class="form-group row">
            <label for="data-price" class="col-sm-2 col-form-label">材料费</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="data-price" id="data-price">
            </div>
          </div>

          <div class="form-group row">
            <label for="time-price" class="col-sm-2 col-form-label">工时费</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="time-price" id="time-price">
            </div>
          </div>



          <div class="form-group">
            <label for="body">修理项目</label>
            <textarea class="form-control" id="body" name="body" rows="3"></textarea>
          </div>


          <div class="form-group row">
            <label for="mend_at" class="col-sm-2 col-form-label">修理时间</label>
            <div class="col-sm-10">
              <input type="date" value="{{date('Y-m-d')}}"  class="form-control" name="mend_at" id="mend_at">
            </div>
          </div>

          <button class="btn btn-primary"  style="float:right">确定</button>
        </form>
      </div>
    </div>    
  </div>
    
@endsection