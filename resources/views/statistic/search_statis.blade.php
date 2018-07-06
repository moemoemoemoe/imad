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
            <center><button class="btn btn-primary" style="width: 100%" onclick="print()">Print</button></center>  
<hr/>
<div id="print">
            <div class="panel panel-default" >
 <div class="panel-heading" style="text-align: center;font-weight: 900;color: red"><span style="color: black">Total:</span>  {{$total_amount}}$ </div>
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
                    <td class="a" style="width: 5%;font-weight: bold;">Option1</td> 
                    <td class="a" style="width: 5%;font-weight: bold;">Option2</td>
                </tr>    
                @foreach($details  as $facture)
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

                   <td class="a" style="width: 5%"><a href="{{route('edit_facture', $facture->id)}}" style="text-decoration: none;">Edit</a></td> 
                   <td style="width: 5%" class="a"><a href="" style="text-decoration: none;">Duplicate</a></td>

               </tr>    

               @endforeach


           </table>

       </div>
     </div>
   </div>
</div>

</div>
<script type="text/javascript">
  
   function print()
    {

         $('.a').hide();

    
     var divToPrint = document.getElementById('print');
     var popupWin = window.open('', '_blank', 'width=1200,height=1200');
     popupWin.document.open();
     popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
     popupWin.document.close();
   }
</script>

@endsection
