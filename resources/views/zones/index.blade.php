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
                <div class="panel-heading">Upload Zone</div>

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" class="well">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <p>
                        <input type="text" name="uid" placeholder="Unique ID" class="form-control" value="{{old('uid')}}" autocomplete="off">
                    </p>
                    <p>
                        <input type="text" name="name" placeholder="Zone Name *" class="form-control" value="{{old('name')}}" autocomplete="off">
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
         @foreach($zones as $zone)
    <div class="col-md-3">
        <div class="panel panel-default" >
            <div class="panel-heading text-center" style="background-color:#ccc ">
                <b style="font-weight: 900;">{{$zone->uid}}</b> 
            </div>
            <div class="panel-body" style="height: 60px;background-color: #fff;font-weight: bold">
              <p>  <span style="color: green;">Zone name : </span><span>{{$zone->name}}</span></p>


            
 

            </div>
           
           
        
           
        <!--  <a href="{{route('delete_zone', $zone->id)}}" class="btn btn-danger form-control">Delete!!</a> -->
           
        </div>
    </div>

    @endforeach
    </div>
</div>
@endsection
