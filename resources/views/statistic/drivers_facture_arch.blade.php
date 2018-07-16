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
         <!--    <center><button class="btn btn-primary" style="width: 100%" onclick="print()">Print</button></center>   -->
<!-- <hr/> -->
<div id="print">
            <div class="panel panel-default" >
 <div class="panel-heading" style="text-align: center;font-weight: 900;color: red"><span style="color: black">Total:</span>  {{$total_amount}}$ / {{count($details)}}  facture/s</div>
 <br/>
</div>
            <div class="panel panel-default">

<!-- 
 <div class="panel-heading" style="text-align: center">
        <form method="POST" enctype="multipart/form-data" class="well">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">


          <p>
            <select class="form-control" name="st"  >

              <option value="0">Werhouse Factures </option>
              <option value="1"> Checked Out Factures</option>
              <option value="2">Return Factures </option>
              <option value="3">Paid Factures</option>


            </select>                </p>
            <p>
              <input type="submit" value="Search" class="btn btn-primary form-control">
            </p>
          </form>
<hr/>

        </div> -->






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
                   <td style="width: 5%;font-weight: bold;">Option5</td>

                </tr>    
                @foreach($details  as $facture)
                <tr>
                   <td style="width: 5%">{{$facture->facture_id}}</td>
                   <td style="width: 10%">{{$facture->customer->name}}</td>
                   <td style="width: 5%">{{$facture->facture->client_name}}</td> 
                   <td style="width: 10%">{{$facture->facture->full_address}}</td>
@if($facture->facture->status == 1)
                   <td style="width: 5%">عادي </td>
                   @else
                   <td style="width: 5%">تبديل وترجيع  </td>
                   @endif

                   <td style="width: 5%">{{$facture->facture->phone_number}}</td>
                   <td style="width: 5%">${{$facture->facture->amount}}</td> 
                   <td style="width: 5%"><?php echo $facture->facture->amount*1500; ?></td>
                <td style="width: 5%">{{($facture->facture->created_at)}}</td> 

                   <td style="width: 5%"><a href="{{route('edit_facture', $facture->id)}}" style="text-decoration: none;" class="btn btn-primary" >Edit</a></td> 

@if($facture->facture->st == 0)
<td style="width: 5%"><a href="{!!route('detail_facture',[$facture->facture->uid,$facture->facture->customer_id,$facture->facture->zone_id]) !!}" style="text-decoration: none;" class="btn btn-primary">Check Out</a></td>
@else
<td style="width: 5%"><a href="{!!route('detail_facture',[$facture->facture->uid,$facture->facture->customer_id,$facture->facture->zone_id]) !!}" style="text-decoration: none;" class="btn btn-danger">Check Out</a></td>
@endif

@if($facture->facture->st == 2)
<td style="width: 5%"><a href="#" style="text-decoration: none;" class="btn btn-danger">Return</a>
</td>
@else
<td style="width: 5%"><a href="{{route('return_facture', $facture->facture->id)}}" style="text-decoration: none;" class="btn btn-primary">Return</a>
</td>
@endif

@if($facture->facture->st > 2)
<td style="width: 5%"><a href="#" style="text-decoration: none;" class="btn btn-danger">Paid</a></td>
@else
<td style="width: 5%"><a href="{{route('paid_facture', $facture->facture->id)}}" style="text-decoration: none;" class="btn btn-primary">Paid</a></td>
@endif 
                   
                   <td style="width: 5%" class="b"><input type="checkbox" class="form-controll" name="check_box_1[]" value="{{$facture->facture->id}}" /></td>

               </tr>    

               @endforeach


           </table>
         <!--    <table style="width: 100%">
          
          <tr>
            <td style="width: 100%;text-align: center;">
            <div style="width: 100%"><span onclick="getLoc()" style="width: 100%" class="form-controll btn btn-primary a" >Print Selected</span></div>
          </td></tr>

          <tr>
            <td style="width: 100%;text-align: center;">
            <div style="width: 100%"><span onclick="getLocClose()" style="width: 100%" class="form-controll btn btn-success a" >Print Selected & Close</span></div>
          </td></tr>
        </table>
 -->
       </div>
     </div>
   </div>
</div>

</div>
<script type="text/javascript">
  
   function print()
    {

         $('.a').hide();
                  $('.b').hide();


    
     var divToPrint = document.getElementById('print');
     var popupWin = window.open('', '_blank','width=1200,height=1200');
     popupWin.document.open();
     popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
     popupWin.document.close();
   }
//      function getLoc(){
//    var checkboxes = document.getElementsByName('check_box_1[]');
// var vals = "";
// for (var i=0, n=checkboxes.length;i<n;i++) 
// {
//     if (checkboxes[i].checked) 
//     {
//         vals += ","+checkboxes[i].value;
//     }
// }
// //alert('localhost/imad/public/print_selected/'+vals.substring(1));
// window.location.href='print_selected_drivers/'+vals.substring(1);
// }
    
</script>

@endsection
