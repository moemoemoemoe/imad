@extends('layouts.app')

@section('content')
<div class="container">
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
                <div class="panel-heading">Upload Customer</div>

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" class="well">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <p>
                        <input type="text" name="uid" placeholder="Unique ID" class="form-control" value="{{old('uid')}}" autocomplete="off">
                    </p>
                    <p>
                        <input type="text" name="name" placeholder="Customer Name *" class="form-control" value="{{old('name')}}" autocomplete="off">
                    </p>
                    <p>
                        <input type="text" name="address" placeholder="Address" class="form-control" value="{{old('address')}}" autocomplete="off">
                    </p>
                     <p>
                        <input type="number" name="phone_number" placeholder="phone number" class="form-control" value="{{old('phone_number')}}" autocomplete="off">
                    </p>
                  
                  <p>
                            <b>Choose Zone</b>
                            
                            <select class="" name="zone[]"  style="width: 20%"  multiple="multiple">
                                @foreach($zones as $zone)

                                <option value="{{$zone->id}}">{{$zone->uid}} -- {{$zone->name}} </option>
                                
                                @endforeach
                            </select>
                            <b>Choose zone Rate $</b>
                            <input type="number" name="ship_one" style="width: 20%" value="{{old('ship_one')}}" />
                            <b>Choose Other Zone Rate $</b>
                            <input type="number" name="other_ship" style="width: 20%" value="{{old('other_ship')}}" />
                        </p>
                  
                <p>
                    <input type="submit" value="Save" class="btn btn-primary form-control">
                </p>

            </form>
                </div>
            </div>
        </div>
   </div>
  <!--  <div class="row">

     <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                 
                </div>
            </div>
        </div>

</div> -->
</div>
<div class="container">
    <div class="row">
         @foreach($customers as $customer)
    <div class="col-md-3">
        <div class="panel panel-default" >
            <div class="panel-heading text-center" style="background-color:#ccc ">
                <b style="font-weight: 900;">{{$customer->uid}}</b> 
            </div>
            <div class="panel-body" style="height: 100px;background-color: #fff;font-weight: bold">
              <p>  <span style="color: green;">Name: </span><span>{{$customer->name}}</span></p>

             
                <p> <span style="color: green;">mobile : </span><span>{{$customer->phone_number}} </span></p>
                
 

            </div>
           
           
                <a href="{{route('update_customer', $customer->id)}}" class="btn btn-primary form-control">Update And Details</a>
                
        
           
       <!--   <a href="{{route('delete_customer', $customer->id)}}" class="btn btn-danger form-control">Delete!!</a> -->
           
        </div>
    </div>

    @endforeach
    </div>
</div>
@endsection
