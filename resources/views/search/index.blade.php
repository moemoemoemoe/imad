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
                <div class="panel-heading" style="text-align: center;font-weight: 900;color: red">Search Fcature by id</div>

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" class="well" action="{{route('search_action',1)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p>
                            <input type="text" name="uid" placeholder="Facture Unique ID" class="form-control typeahead"  autocomplete="off">
                        </p>

                        <p>
                            <input type="submit" value="Search" class="btn btn-primary form-control">
                        </p>

                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;font-weight: 900;color: red">Search Facture By Customer</div>

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" class="well" action="{{route('search_action',2)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <p>
                            <select class="form-control" name="customer_id"  >
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}} --- {{$customer->uid}} </option>
                                @endforeach

                            </select>                </p>
  <p>
                            <input type="submit" value="Search" class="btn btn-primary form-control">
                        </p>
                        </form>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;font-weight: 900;color: red">Search Fcature by Zone</div>

                    <div class="panel-body">
                        <form method="POST" enctype="multipart/form-data" class="well" action="{{route('search_action',3)}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>
                             <select class="form-control" name="zone_id"  >
                                @foreach($zones as $zone)
                                <option value="{{$zone->id}}">{{$zone->name}} --- {{$zone->uid}} </option>
                                @endforeach

                            </select>
                        </p>

                        <p>
                            <input type="submit" value="Search" class="btn btn-primary form-control">
                        </p>

                    </form>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center;font-weight: 900;color: red">Search Fcature by Driver</div>

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" class="well" action="{{route('search_action',4)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p>
                         <select class="form-control" name="driver_id">
                            @foreach($drivers as $driver)
                            <option value="{{$driver->uid}}">{{$driver->name}} --- {{$driver->uid}} </option>
                            @endforeach

                        </select>  
                    </p>

                    <p>
                        <input type="submit" value="Search" class="btn btn-primary form-control">
                    </p>

                </form>
            </div>
        </div>
    </div>
</div>

</div>

@endsection
