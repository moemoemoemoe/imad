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

   <div class="panel-heading" style="color: red;font-weight: 900;text-align: center;">Assign Facture to a Driver</div>
 

  <div class="panel-heading" style="text-align: center;color: blue;font-weight: 900"># {{$factures[0]->uid}}</div>
                <div class="panel-body">
                  
                    <form method="POST" enctype="multipart/form-data" class="well">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <p>
                        <b>Choose Driver</b>
                    </p>
                    <p>
                        <select class="form-control" name="driver_id"  >
                            @foreach($drivers as $driver)
                            <option value="{{$driver->uid}}">{{$driver->name}}  -- {{$driver->uid}} </option>
                            @endforeach

                        </select>
                    </p>
                     
                  
                <p>
                    <input type="submit" value="Assign" class="btn btn-primary form-control">
                </p>

            </form>
           
                </div>
            </div>
        </div>
   </div>
  
</div>

@endsection
