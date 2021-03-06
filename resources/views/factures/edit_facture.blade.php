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

                <div class="panel-body">
                    <form method="POST" enctype="multipart/form-data" class="well">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <p>
                        <input type="text" name="uid" placeholder="Facture Unique ID" class="form-control" value="{{$factures[0]->uid}}" autocomplete="off" readonly="readonly">
                    </p>
                    <p>
                        <input type="text" name="client_name" placeholder="Client Name *" class="form-control" value="{{$factures[0]->client_name}}" autocomplete="off">
                    </p>
                    <p>
                        <textarea type="text" name="full_address" placeholder="Full Address" class="form-control" value="{{old('full_address')}}" autocomplete="off"> {{$factures[0]->full_address}}</textarea> 
                    </p>
                     <p>
                        <input type="number" name="phone_number" placeholder="phone number" class="form-control" value="{{$factures[0]->phone_number}}" autocomplete="off">
                    </p>
                     <p>
                        <input type="text" name="amount" placeholder="Amount in $" class="" value="{{$factures[0]->amount}}" autocomplete="off" style="width:45%" id ="amount_d" onchange="toLb();">

                         <input type="text" name="amount_ll" placeholder="Amount in L.L" class="" value='<?php echo $factures[0]->amount*1500;  ?>' autocomplete="off" style="width: 45%" id="amount_ll" onchange="toDl();">
                    </p>
                  
                     <p>
                        <b>Choose customer</b>
                    </p>
                    <p>
                        <select class="form-control" name="customer_id"  >
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}" {{ ($customer->id == $factures[0]->customer->id) ? 'selected' : '' }}>{{$customer->name}}</option>
                            @endforeach

                        </select>
                    </p>
                    <p>
                        <b>Choose Zone</b>
                    </p>
                    <p>
                        <select class="form-control" name="zone_id"  >
                            @foreach($zones as $zone)
                          <option value="{{$zone->id}}" {{ ($zone->id == $factures[0]->zone->id) ? 'selected' : '' }}>{{$zone->name}}</option>
                            @endforeach

                        </select>
                    </p>
                     <p>
                        <b>Choose status</b>
                    </p>
                    <p>
                        <select class="form-control" name="status"  >
                            @if($factures[0]->status == 1)
                            <option value="1">  عادي   </option>
                              <option value="2">  تبديل وترجيع   </option>
                              @else
                              <option value="2">  تبديل وترجيع   </option>
                              <option value="1">  عادي   </option>
                              
                              @endif
                            

                        </select>
                    </p>
                   <p>
                        <textarea type="text" name="comment" placeholder="Leave Comment" class="form-control" value="{{$factures[0]->comment}}" autocomplete="off">{{$factures[0]->comment}} </textarea> 
                    </p>
                <p>
                    <input type="submit" value="Save" class="btn btn-primary form-control">
                </p>

            </form>
                </div>
            </div>
        </div>
   </div>
  
</div>
<script type="text/javascript">
    function toLb() {
        var input = document.getElementById('amount_d'),
        dolar = input.value;
        document.getElementById("amount_ll").value = dolar*1500;
        // body...
    }
     function toDl() {
       var input = document.getElementById('amount_ll'),
        lib = input.value;
        document.getElementById("amount_d").value = lib/1500;
        // body...
    }
</script>
@endsection
