@extends('layouts.app')

@section('content')
<div class="">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12 " style="text-align: center;">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if(Session::has('success'))
        <p class="alert alert-success">{!! Session('success') !!}</p>
        @endif

      </div>
      <div class="panel panel-default">

      



        <table border="1" style="text-align: center;font-weight: 5">
         <tr>
          <td style="width: 5%;font-weight: bold;">Customer UID</td> 
          <td style="width: 10% ;font-weight: bold;">Customer Name</td> 
          <td style="width: 10%;font-weight: bold;">Address</td> 
          <td style="width: 5%;font-weight: bold;">Tel Number</td> 
          <td style="width: 5%;font-weight: bold;">Date</td> 
          <td style="width: 5%;font-weight: bold;">Option 1</td> 
                    <td style="width: 5%;font-weight: bold;">Option 2</td> 

        </tr>    
        @foreach($customers  as $customer)
        <tr>
         <td style="width: 5%">{{$customer->uid}}</td>
         <td style="width: 10%">{{$customer->name}}</td>
         <td style="width: 10%">{{$customer->address}}</td>
         <td style="width: 5%">{{$customer->phone_number}}</td>
         <td style="width: 5%">{{$customer->created_at}}</td> 
         <td style="width: 5%"><a  class="btn btn-primary" href="{{route('customer_factures', $customer->id)}}" style="text-decoration: none;">View Factures</a></td>
            <td style="width: 5%"><a " href="{{route('customer_factures_archived', $customer->id)}}" style="text-decoration: none;">Archived</a></td>

       </tr>    

       @endforeach


     </table>

   </div>
 </div>
</div>

</div>

@endsection
