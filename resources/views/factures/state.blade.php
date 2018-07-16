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
                    <td style="width: 5%;font-weight: bold;">Option2</td>
                    <td style="width: 5%;font-weight: bold;">Option3</td>
                    <td style="width: 5%;font-weight: bold;">Option4</td>
                </tr>    
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
@if($facture->is_printed == 0)
@if($facture->st == 0)
<td style="width: 5%"><a href="{!!route('detail_facture',[$facture->uid,$facture->customer_id,$facture->zone_id]) !!}" style="text-decoration: none;" class="btn btn-primary">Check Out</a></td>
@else
<td style="width: 5%"><a href="{!!route('detail_facture',[$facture->uid,$facture->customer_id,$facture->zone_id]) !!}" style="text-decoration: none;" class="btn btn-danger">Check Out</a></td>
@endif

@if($facture->st == 2)
<td style="width: 5%"><a href="#" style="text-decoration: none;" class="btn btn-danger">Return</a>
</td>
@else
<td style="width: 5%"><a href="{{route('return_facture', $facture->id)}}" style="text-decoration: none;" class="btn btn-primary">Return</a>
</td>
@endif

@if($facture->st > 2)
<td style="width: 5%"><a href="#" style="text-decoration: none;" class="btn btn-danger">Paid</a></td>
@else
<td style="width: 5%"><a href="{{route('paid_facture', $facture->id)}}" style="text-decoration: none;" class="btn btn-primary">Paid</a></td>
@endif
@else
<td style="width: 5%"><a href="#" style="text-decoration: none;" class="btn btn-success">closed</a></td>
<td style="width: 5%"><a href="#" style="text-decoration: none;" class="btn btn-success">closed</a></td>
<td style="width: 5%"><a href="#" style="text-decoration: none;" class="btn btn-success">closed</a></td>

@endif


               </tr>    

               @endforeach


           </table>

       </div>
   </div>
</div>

</div>

@endsection
