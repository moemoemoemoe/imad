@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Factures</div>
            </div>
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
          
        </div>
   </div>
 
</div>
<div class="container">
    <div class="row">
         @foreach($factures as $facture)
    <div class="col-md-3">
        <div class="panel panel-default" >
            <div class="panel-heading text-center" style="background-color:#ddd ">
                <b style="font-weight: 900;color: #ff0000"># {{$facture->uid}}</b> 
                    - <span class="pull-right">

                @if($facture->status == 1)
               
                <i class="fa fa-check text-success" >عادي </i>
@else               <i class="fa fa-times-circle text-primary" >تبديل وترجع </i>
@endif
                </span>
                <hr/>

                <p>
                <b style="font-weight: 900;"> {{$facture->client_name}}</b> 
            </p>
            </div>
            <div class="panel-body" style="height: 180px;background-color: #fff;font-weight: bold">
         
             <!--  <p>  <span style="color: green;">mobile number : </span><span>{{$facture->phone_number}}</span></p> -->
              <p>   <span style="color: green;">Amount : </span><span>{{$facture->amount}} $ / <?php
              echo $facture->amount*1500;
              ?></span></p>
                <p> <span style="color: green;">Date : </span><span>{{$facture->created_at}} </span></p>
                  <p> 
            <span style="color: red;">Resource Name : </span>
            <span style="font-weight: bold">{{$facture->customer->name}}</span>
        </p>
         <p> 
            @foreach($facture->detail as $d)
           
             <span style="color: red;">Driver Name : </span>
            <span style="font-weight: bold">{{$d->driver_id}}</span>
           
            @endforeach
        </p>
  </div>
           
           
  <a href="{!! route('detail_facture',[$facture->uid,$facture->customer_id,$facture->zone_id]) !!}" class="btn btn-primary form-control">Assign To Driver</a>
                <br/>
        
           
        
           
        </div>
    </div>

    @endforeach
    </div>
</div>
@endsection
