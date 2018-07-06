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
                <div class="panel-heading">update Driver</div>

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" class="well">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <p>
                        <input type="text" name="uid" placeholder="Unique ID" class="form-control" value="{{$drivers->uid}}" autocomplete="off">
                    </p>
                    <p>
                        <input type="text" name="name" placeholder="Customer Name *" class="form-control" value="{{$drivers->name}}" autocomplete="off">
                    </p>
                   
                     <p>
                        <input type="text" name="phone_number" placeholder="phone number" class="form-control" value="{{$drivers->phone_number}}" autocomplete="off">
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