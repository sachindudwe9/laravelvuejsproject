@extends('layouts.app')
@section('content')
<div class="container jumbotron">
<h2>Add Coupon</h2>
<br>
<form method="post" action="/updatecoupon/{{$coupondata->id}}" >
   @csrf()    
   @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success ">{{Session::get('success')}}</div>
    @endif

    <div class="form-group">
          <label>Coupon Name </label>
          <input type="text" class="form-control" name="couponname" value="{{$coupondata->couponname}}" />
          @if($errors->has('couponname'))
          <div class="alert alert-danger">{{$errors->first('couponname')}}</div>
          @endif
      </div>

      <div class="form-group">
          <label>Coupon Code </label>
          <input type="text" class="form-control" name="couponcode" value="{{$coupondata->couponcode}}"/>
          @if($errors->has('couponcode'))
          <div class="alert alert-danger">{{$errors->first('couponcode')}}</div>
          @endif
      </div>

      <div class="form-group">
          <label>Discount </label>
          <input type="text" class="form-control" name="discount" value="{{$coupondata->discount}}"/>
          @if($errors->has('discount'))
          <div class="alert alert-danger">{{$errors->first('discount')}}</div>
          @endif
      </div>
      

      <input type="submit" value="Submit" class="btn btn-info"/>
  </form>
</div>
@endsection