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
                    <td style="width: 5%;font-weight: bold;">Driver UID</td> 
                    <td style="width: 10% ;font-weight: bold;">Driver Name</td> 
                    <td style="width: 5%;font-weight: bold;">Tel Number</td> 
                    <td style="width: 5%;font-weight: bold;">Date</td> 
                    <td style="width: 5%;font-weight: bold;">Option 1</td> 
                </tr>    
                @foreach($drivers  as $driver)
                <tr>
                   <td style="width: 5%">{{$driver->uid}}</td>
                   <td style="width: 10%">{{$driver->name}}</td>
                   <td style="width: 5%">{{$driver->phone_number}}</td>
                   <td style="width: 5%">{{$driver->created_at}}</td> 
                   <td style="width: 5%"><a href="{{route('driver_factures', $driver->uid)}}" style="text-decoration: none;">View Factures</a></td>
                   
               </tr>    

               @endforeach


           </table>

       </div>
   </div>
</div>

</div>

@endsection
