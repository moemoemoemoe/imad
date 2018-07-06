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
 <div class="panel-heading" style="text-align: center;font-weight: 900;color: red">Facture</div>

             <table border="1" style="text-align: center;font-weight: 5">
                 <tr>
                    <td style="width: 5%;font-weight: bold;">Order Id</td>
                    <td style="width: 5%;font-weight: bold;">Date Rcvd</td>
                    <!-- <td style="width: 10% ;font-weight: bold;">Business Name</td>  -->
                     <td style="width: 5%;font-weight: bold;">Customer</td> 
                     <td style="width: 10%;font-weight: bold;">Address</td> 
<!--                      <td style="width: 5%;font-weight: bold;">Status</td>
 -->                    <td style="width: 5%;font-weight: bold;">Tel Number</td> 
                    <td style="width: 5%;font-weight: bold;">Amount $</td> 
                    <td style="width: 5%;font-weight: bold;">Amount LL</td> 
                     <td style="width: 5%;font-weight: bold;">Collected $</td> 
                    <td style="width: 5%;font-weight: bold;">Shipping $</td> 
                     <td style="width: 5%;font-weight: bold;">Net Amount $</td> 
                    <td style="width: 5%;font-weight: bold;">Option1</td>
                    
                   <!--  <td style="width: 5%;font-weight: bold;">Option1</td> 
                    <td style="width: 5%;font-weight: bold;">Option2</td> -->
                </tr>    
                @foreach($details  as $facture)
                <form method="POST" enctype="multipart/form-data" class="well" action="{{route('edit_facture_dri', $facture->facture->id)}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <tr>
                   <td style="width: 5%">{{$facture->facture_id}}</td>
                   <td style="width: 5%">{{($facture->facture->created_at)}}</td> 
<!--                    <td style="width: 10%">{{$facture->customer->name}}</td>
 -->                   <td style="width: 5%">{{$facture->facture->client_name}}</td> 
                   <td style="width: 10%">{{$facture->facture->full_address}}</td>
<!-- @if($facture->facture->status == 1)
                   <td style="width: 5%">عادي </td>
                   @else
                   <td style="width: 5%">تبديل وترجيع  </td>
                   @endif -->

                   <td style="width: 5%">{{$facture->facture->phone_number}}</td>
                   <td style="width: 5%">${{$facture->facture->amount}}</td> 
                   <td style="width: 5%"><?php echo $facture->facture->amount*1500; ?></td>

                  <td style="width: 5%"><input type="text" name="collected" value="{{$facture->facture->collected}}" autocomplete="off" style="text-align: center;" /></td>
                   <td style="width: 5%">
                   
                    <input type="number" name="shipping" value="{{$facture->facture->rate}}" autocomplete="off"  style="text-align: center;"/>
                   


                  </td> 
                   <td style="width: 5%">
                   
                    <input type="text" name="net" autocomplete="off"  style="text-align: center;" value="{{$facture->facture->net_amount}}" />
                    

                   </td>
                
<td style="width: 5%">
<input type="submit" value="Update" class="btn btn-primary form-control">
<!--   <a href="{{route('edit_facture', $facture->facture->id)}}" style="text-decoration: none;" class="btn btn-primary">Update</a></td> -->
</td>
                 <!--   <td style="width: 5%"><a href="{{route('edit_facture', $facture->facture->id)}}" style="text-decoration: none;">Edit</a></td> 
                   <td style="width: 5%"><a href="" style="text-decoration: none;">Duplicate</a></td> -->

               </tr>    
 </form>
               @endforeach


           </table>
        

       </div>
   </div>
</div>

</div>

@endsection
