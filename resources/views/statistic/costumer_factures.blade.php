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
<center><button class="btn btn-primary" style="width: 100%" onclick="print()">Print</button></center>  
<hr/>

        </div>
            <div class="panel panel-default"  id="print">
 <div class="panel-heading" style="text-align: center;font-weight: 900;color: red">Customer : <span style="color: black">{{$factures[0]->customer->name}} </span> </div>
  <div class="panel-heading" style="text-align: center;font-weight: 900;color: red">
<span style="color: #000">Orders Total : </span> ${{$total_amount}} -
<span style="color: #000">Collected : </span> ${{$total_collected}} -

<span style="color: #000">Shipping : </span> ${{$total_shipping}} -
<span style="color: #000">Net Due : </span> ${{$total_net_amount}}




   </div>

             <table border="1" style="text-align: center;font-weight: 3;font-size: 13px">
                 <tr>
                    <td style="width: 10%;font-weight: bold;">Order Id</td>
                    <td style="width: 10%;font-weight: bold;">Date Rcvd</td>
                    <!-- <td style="width: 10% ;font-weight: bold;">Business Name</td>  -->
                     <td style="width: 10%;font-weight: bold;">Customer</td> 
                     <td style="width: 10%;font-weight: bold;">Address</td> 
                     <td style="width: 10%;font-weight: bold;">Status</td>
                    <td style="width: 10%;font-weight: bold;">Tel Number</td> 
                    <td style="width: 10%;font-weight: bold;">Amount $</td> 
                    <td style="width: 10%;font-weight: bold;">Amount LL</td> 
                     <td style="width: 10%;font-weight: bold;">Collected $</td> 
                    <td style="width: 10%;font-weight: bold;">Shipping $</td> 
                     <td style="width: 10%;font-weight: bold;">Net Amount $</td> 
                    <td style="width: 10%;font-weight: bold;" class="a">Option1</td>
           <td style="width: 5%;font-weight: bold;" class="a">Option2</td>

                    
                   <!--  <td style="width: 5%;font-weight: bold;">Option1</td> 
                    <td style="width: 5%;font-weight: bold;">Option2</td> -->
                </tr>    
                @foreach($factures  as $facture)
                <form method="POST" enctype="multipart/form-data" class="well" action="{{route('edit_facture_dri', $facture->id)}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if($facture->st == 2)
                <tr style="background-color: #f4a3a3">
                  @elseif($facture->st == 3)
                <tr style="background-color: #acf2bf">
@else
<tr>
                  @endif

                   <td style="width: 10%">{{$facture->uid}}</td>
                   <td style="width: 10%">{{($facture->created_at)}}</td> 
<!--                    <td style="width: 10%">{{$facture->customer->name}}</td>
 -->                   <td style="width: 10%">{{$facture->client_name}}</td> 
                   <td style="width: 10%">{{$facture->full_address}}</td>
@if($facture->status == 1)
                   <td style="width: 10%">عادي </td>
                   @else
                   <td style="width: 10%">تبديل وترجيع  </td>
                   @endif

                   <td style="width: 10%">{{$facture->phone_number}}</td>
                   <td style="width: 10%">${{$facture->amount}}</td> 
                   <td style="width: 10%"><?php echo $facture->amount*1500; ?></td>

                  <td style="width: 10%"><input type="text" name="collected" value="{{$facture->collected}}" autocomplete="off" style="text-align: center;width: 60px" /></td>
                   <td style="width: 10%">
                   
                    <input type="number" name="shipping" value="{{$facture->rate}}" autocomplete="off"  style="text-align: center; width: 50px"/>
                   


                  </td> 
                   <td style="width: 10%">
                   
                    <input type="text" name="net" autocomplete="off"  style="text-align: center;width: 80px" value="{{$facture->net_amount}}" readonly="readonly" />
                    

                   </td>
                
<td style="width: 10%" class="b">
<input type="submit" value="Update" class="btn btn-primary form-control" >
<!--   <a href="{{route('edit_facture', $facture->id)}}" style="text-decoration: none;" class="btn btn-primary">Update</a></td> -->
</td>
<td style="width: 5%" class="b"><input type="checkbox" class="form-controll" name="check_box_1[]" value="{{$facture->id}}" /></td> 
                 <!--   <td style="width: 5%"><a href="{{route('edit_facture', $facture->id)}}" style="text-decoration: none;">Edit</a></td> 
                   <td style="width: 5%"><a href="" style="text-decoration: none;">Duplicate</a></td> -->

               </tr>    
 </form>
               @endforeach


           </table>
        <table style="width: 100%">
          
          <tr><td style="width: 100%;text-align: center;">
            <div style="width: 100%"><span onclick="getLoc()" style="width: 100%" class="form-controll btn btn-primary a" >Print Selected</span></div>
          </td></tr>
        </table>

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
     var popupWin = window.open('', '_blank', 'width=1200,height=1200');
     popupWin.document.open();
     popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
     popupWin.document.close();
   }

   function getLoc(){
   var checkboxes = document.getElementsByName('check_box_1[]');
var vals = "";
for (var i=0, n=checkboxes.length;i<n;i++) 
{
    if (checkboxes[i].checked) 
    {
        vals += ","+checkboxes[i].value;
    }
}
//alert('localhost/imad/public/print_selected/'+vals.substring(1));
window.location.href='print_selected/'+vals.substring(1);
}
</script>

@endsection
