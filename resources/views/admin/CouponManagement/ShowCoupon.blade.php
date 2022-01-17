@extends('dashboard')
@section('content1')
 <style>
    .btn{
      float: right;
    }
    .AddCoupon{
      color: red;
    }
 </style>
 <div class="bg-white"> 
<div class="AddCoupon">
  <a class="btn btn-primary" href="coupons/create">Add Coupon<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
  </svg></a><br><br><br>
</div>
  <div class="container">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Coupon Code</th>
      <th scope="col">Coupon Type</th>
      <th scope="col">Coupon Value</th>
      <th scope="col">Status</th>
      <th colspan="2" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
   @if(count($data)>0) 
      @php
      $sn=1;
      @endphp
      @foreach($data as $i)
    <tr>
      <td>{{$sn}}</td>
      <td>{{$i->code}}</td>
      <!-- <td>{{$i->type}}</td> -->
      <td>
         @if($i->type=='fixed')
          <span class="badge badge-primary">{{$i->type}}</span>
        @else
          <span class="badge badge-warning">{{$i->type}}</span>
        @endif
        </td>
        <td>
         @if($i->type=='fixed')
         ${{number_format($i->value,2)}}
         @else
        {{$i->value}}%
        @endif</td>
      <td>{{$i->value}}</td>
      @if($i->status=='active')
          <td class="text-success">Active</td>
      @else
      <td class="text-danger">Inactive</td>
      @endif
      <td>
        <a href="/coupons/{{$i->id}}/edit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
        </svg></a></td>
      </td>
      <td>
      <!-- <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#exampleModalCenter">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
      </svg></button>
     </button> -->
<!--------model--------->
<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-red">
        Do you Really Want to Delete...?
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="/deleteCoupon/{{$i->id}}" class="btn btn-danger">
        Delete</a>
     </div>
    </div>
</div> -->
  <!-----endmodal--------->
  <form action="/coupons/{{$i->id}}/" method="post">
  @csrf()
  @method('delete')
<button type="submit" onclick="return confirm('Do you really want to delete Coupon {{$i->code}}!')" class="btn btn-danger">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
  </svg>
</button>
</form>
      </td>
  @php
     $sn++;
  @endphp
    </tr> 
  @endforeach
  @else
  <tr>
    <td class="record text-red text-center" colspan="10"> No records found</td>
  </tr> 
  @endif
</tbody>
</table>
{{$data->links("pagination::bootstrap-4")}}
  </div><br><br>
 </div> 
@endsection

