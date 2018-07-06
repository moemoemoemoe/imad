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
                <div class="panel-heading">update Customer</div>

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" class="well">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <p>
                        <input type="text" name="uid" placeholder="Unique ID" class="form-control" value="{{$customers->uid}}" autocomplete="off">
                    </p>
                    <p>
                        <input type="text" name="name" placeholder="Customer Name *" class="form-control" value="{{$customers->name}}" autocomplete="off">
                    </p>
                    <p>
                        <input type="text" name="address" placeholder="Address" class="form-control" value="{{$customers->address}}" autocomplete="off">
                    </p>
                     <p>
                        <input type="text" name="phone_number" placeholder="phone number" class="form-control" value="{{$customers->phone_number}}" autocomplete="off">
                    </p>
                  
                    
                  <p>
                            <b>Choose Zone</b>
                            
                            <select class="" name="zone[]"  style="width: 20%"  multiple="multiple">
                                @foreach($zones as $zone)

                                 <option value="{{$zone->id}}" @foreach($shipping as $ship){{ (

                                    $zone->id == $ship->zone_id) ? 'selected' : '' 

                                }}@endforeach>{{$zone->uid}} -- {{$zone->name}}</option>
                                
                                
                                @endforeach
                            </select>
                            <b>Choose zone Rate $</b>
                            <input type="number" name="ship_one" style="width: 20%" value="{{$shipping[0]->ship_one}}" />
                            <b>Choose Other Zone Rate $</b>
                            <input type="number" name="other_ship" style="width: 20%" value="{{$shipping[0]->other_ship}}" />
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
@endsection