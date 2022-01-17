@extends('layouts.app')
@section('content')
<div class="jumbotron container">
  <h1 class="text-center mt-3 mb-3"> Coupons </h1>
  @if(Session::has('errMsg'))
    <div class="alert alert-danger">{{Session::get('errMsg')}}</div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success ">{{Session::get('success')}}</div>
    @endif
  <table class="table table-bordered table-hover">
  <thead class="thead-dark">
      
      <tr>
          <th scope="col">S.no</th>
          <th scope="col">Coupon Name</th>
          <th scope="col">Coupon Code</th>
          <th scope="col">Discount</th>
          <th scope="col"> Actions</th>
      </tr>
  </thead>
      @php 
       $sn=1;
      @endphp
      @foreach($coupon as $cat)
        <tr>
            <td>{{$sn}}</td>
            <td>{{$cat->couponname}}</td>
            <td>{{$cat->couponcode}}</td>
            <td>{{$cat->discount}}</td>
            <td>
                <a href="/editcoupon/{{$cat->id}}" class="btn btn-primary">Edit</a>&nbsp;
                <a href="/deletecoupon/{{$cat->id}}"  class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
            </td>
        </tr>
      @php 
       $sn++;
      @endphp
      @endforeach
  </table>
</div>
@endsection