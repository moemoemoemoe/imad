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
                    <td style="width: 5%;font-weight: bold;">Order Id</td>
                     <td style="width: 10% ;font-weight: bold;">Business Name</td> 
                     <td style="width: 5%;font-weight: bold;">Customer</td> 
                     <td style="width: 10%;font-weight: bold;">Address</td> 
                     <td style="width: 5%;font-weight: bold;">Status</td>
                    <td style="width: 5%;font-weight: bold;">Tel Number</td> 
                    <td style="width: 5%;font-weight: bold;">Amount $</td> 
                    <td style="width: 5%;font-weight: bold;">Amount LL</td> 
                    <td style="width: 5%;font-weight: bold;">Date</td>
                    <td style="width: 5%;font-weight: bold;">Option1</td> 
                   <td style="width: 5%;font-weight: bold;">Check</td> 

                   
                </tr>   
                 <form method="GET" enctype="multipart/form-data" class="well" action="{{route('werhouse_checkout')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                @foreach($factures  as $facture)
                
                <tr>
                   <td style="width: 5%">{{$facture->uid}}</td>
                   <td style="width: 10%">{{$facture->customer->name}}</td>
                   <td style="width: 5%">{{$facture->client_name}}</td> 
                   <td style="width: 10%">{{$facture->full_address}}</td>
@if($facture->status == 1)
                   <td style="width: 5%">عادي </td>
                   @else
                   <td style="width: 5%">تبديل وترجيع  </td>
                   @endif

                   <td style="width: 5%">{{$facture->phone_number}}</td>
                   <td style="width: 5%">${{$facture->amount}}</td> 
                   <td style="width: 5%"><?php echo $facture->amount*1500; ?></td>
                <td style="width: 5%">{{($facture->created_at)}}</td> 

<td style="width: 5%"><a href="{{route('edit_facture', $facture->id)}}" style="text-decoration: none;" class="btn btn-primary" >Edit</a></td> 



<td style="width: 5%"><input type="checkbox" class="form-controll" name="check_box_1[]" value="{{$facture->id}}" /></td> 





               </tr>    


               @endforeach
               <p>
             <tr>  <input type="submit" value="Checkout" class="btn btn-primary form-control">
</tr></p>
</form>

           </table>

       </div>
   </div>
</div>

</div>

@endsection
