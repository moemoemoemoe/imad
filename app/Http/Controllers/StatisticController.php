<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facture;
use App\Detail;
use Redirect;
use Validator;


class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer_factures($id)
    {

    $factures = Facture::with('customer')->orderBy('uid','ASC')->where('customer_id',$id)->where('is_printed_customer',0)->get();
    if(count($factures) == 0)
        {
            return Redirect::Back()->withErrors('No Factures Assigned To this Customer');

        }
        else{

     $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($factures);$i++)
            {
                $total_amount = $total_amount  + $factures[$i]->amount;
                $total_collected = $total_collected  + $factures[$i]->collected;
                $total_shipping = $total_shipping  + $factures[$i]->rate;
                $total_net_amount = $total_net_amount  + $factures[$i]->net_amount;

            }
    return view('statistic.costumer_factures',compact('factures','total_amount','total_collected','total_shipping','total_net_amount'));
   }
    }
 public function customer_factures_archived($id)
    {

    $factures = Facture::with('customer')->orderBy('uid','ASC')->where('customer_id',$id)->get();
    if(count($factures) == 0)
        {
            return Redirect::Back()->withErrors('No Factures Assigned To this Customer');

        }
        else{

     $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($factures);$i++)
            {
                $total_amount = $total_amount  + $factures[$i]->amount;
                $total_collected = $total_collected  + $factures[$i]->collected;
                $total_shipping = $total_shipping  + $factures[$i]->rate;
                $total_net_amount = $total_net_amount  + $factures[$i]->net_amount;

            }
    return view('statistic.costumer_factures',compact('factures','total_amount','total_collected','total_shipping','total_net_amount'));
   }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function driver_factures($id)
    {
        $details = Detail::with('facture')->with('customer')->with('zone')->where('driver_id',$id)->where('is_printed',0)->get();
        //return $details;

        
        if(count($details) == 0)
        {
            return Redirect::Back()->withErrors('No Factures Assigned To this Driver');

        }
        else{
            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($details);$i++)
            {
                $total_amount = $total_amount  + $details[$i]->facture->amount;
                $total_collected = $total_collected  + $details[$i]->facture->collected;
                $total_shipping = $total_shipping  + $details[$i]->facture->rate;
                $total_net_amount = $total_net_amount  + $details[$i]->facture->net_amount;

            }
        
         return view('statistic.drivers_facture',compact('details','total_amount','total_collected','total_shipping','total_net_amount'));
    }}
    public function driver_factures_arch($id)
    {
        $details = Detail::with('facture')->with('customer')->with('zone')->where('driver_id',$id)->get();
        //return $details;

        
        if(count($details) == 0)
        {
            return Redirect::Back()->withErrors('No Factures Assigned To this Driver');

        }
        else{
            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($details);$i++)
            {
                $total_amount = $total_amount  + $details[$i]->facture->amount;
                $total_collected = $total_collected  + $details[$i]->facture->collected;
                $total_shipping = $total_shipping  + $details[$i]->facture->rate;
                $total_net_amount = $total_net_amount  + $details[$i]->facture->net_amount;

            }
        
         return view('statistic.drivers_facture_arch',compact('details','total_amount','total_collected','total_shipping','total_net_amount'));
    }}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit_facture_dri($id,Request $r)
    {
        $collected = $r->input('collected');
        $shipping = $r->input('shipping');
        $net = $r->input('net');

        $data = ['collected' => $collected,'shipping'=> $shipping,'net' => $net];

            $rules = ['collected' => 'required' ,'shipping' => 'required','net'=> 'required'];

            $v = Validator::make($data, $rules);
            if($v->fails()){
                return Redirect::Back()->withErrors($v)->withInput($r->input());
            }else
            {
                $factures = Facture::findOrFail($id);
                $factures->collected = $collected;
                $factures->rate = $shipping;
                $factures->net_amount =$collected - $shipping ;
$factures->save();

 return Redirect::Back()->with('success', 'Updated successfully');




            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customer_factures_search($id,Request $r)
    {
        $status = $r->input('st');

    $factures = Facture::with('customer')->orderBy('uid','DESC')->where('customer_id',$id)->where('st',$status)->get();
    if(count($factures) == 0)
        {
            return Redirect::Back()->withErrors('No Factures Assigned To this Status');

        }
        else{

     $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($factures);$i++)
            {
                $total_amount = $total_amount  + $factures[$i]->amount;
                $total_collected = $total_collected  + $factures[$i]->collected;
                $total_shipping = $total_shipping  + $factures[$i]->rate;
                $total_net_amount = $total_net_amount  + $factures[$i]->net_amount;

            }
    return view('statistic.costumer_factures',compact('factures','total_amount','total_collected','total_shipping','total_net_amount'));
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print_selected($ids)
    {
        $myString = $ids;
$myArray = explode(',', $myString);
// print_r($myArray);
$factures = Facture::whereIn('id', $myArray)->orderBy('uid','ASC')->get();
//return $result;

 if(count($factures) == 0)
        {
            return Redirect::Back()->withErrors('No Factures selected');

        }
        else{

            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($factures);$i++)
            {
                $total_amount = $total_amount  + $factures[$i]->amount;
                $total_collected = $total_collected  + $factures[$i]->collected;
                $total_shipping = $total_shipping  + $factures[$i]->rate;
                $total_net_amount = $total_net_amount  + $factures[$i]->net_amount;

            }
    return view('statistic.costumer_checked',compact('factures','total_amount','total_collected','total_shipping','total_net_amount'));
    }

    }
        public function print_selected_close($ids)
    {
        $myString = $ids;
$myArray = explode(',', $myString);
// print_r($myArray);
$factures = Facture::whereIn('id', $myArray)->orderBy('uid','ASC')->get();
//return $result;

 if(count($factures) == 0)
        {
            return Redirect::Back()->withErrors('No Factures selected');

        }
        else{
  $factures_update = Facture::whereIn('id', $myArray)->update(['is_printed_customer'=>1]);
$details_update = Detail::whereIn('f_id', $myArray)->update(['is_printed_customer'=>1]);

            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($factures);$i++)
            {
                $total_amount = $total_amount  + $factures[$i]->amount;
                $total_collected = $total_collected  + $factures[$i]->collected;
                $total_shipping = $total_shipping  + $factures[$i]->rate;
                $total_net_amount = $total_net_amount  + $factures[$i]->net_amount;

            }
    return view('statistic.costumer_checked',compact('factures','total_amount','total_collected','total_shipping','total_net_amount'));
    }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print_selected_drivers($ids)
    {
              $myString = $ids;
$myArray = explode(',', $myString);
// print_r($myArray);
$factures = Facture::whereIn('id', $myArray)->with('customer')->orderBy('uid','ASC')->get();
//return $result;

 if(count($factures) == 0)
        {
            return Redirect::Back()->withErrors('No Factures selected');

        }
        else{

            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($factures);$i++)
            {
                $total_amount = $total_amount  + $factures[$i]->amount;
                $total_collected = $total_collected  + $factures[$i]->collected;
                $total_shipping = $total_shipping  + $factures[$i]->rate;
                $total_net_amount = $total_net_amount  + $factures[$i]->net_amount;

            }
    return view('statistic.driver_checked',compact('factures','total_amount','total_collected','total_shipping','total_net_amount'));
    }
    }
     public function print_selected_drivers_close($ids)
    {
              $myString = $ids;
$myArray = explode(',', $myString);
// print_r($myArray);
$factures = Facture::whereIn('id', $myArray)->with('customer')->orderBy('uid','ASC')->get();


//return $result;

 if(count($factures) == 0)
        {
            return Redirect::Back()->withErrors('No Factures selected');

        }
        else{
            $factures_update = Facture::whereIn('id', $myArray)->update(['is_printed'=>1]);
$details_update = Detail::whereIn('f_id', $myArray)->update(['is_printed'=>1]);


            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($factures);$i++)
            {
                $total_amount = $total_amount  + $factures[$i]->amount;
                $total_collected = $total_collected  + $factures[$i]->collected;
                $total_shipping = $total_shipping  + $factures[$i]->rate;
                $total_net_amount = $total_net_amount  + $factures[$i]->net_amount;

            }


    return view('statistic.driver_checked',compact('factures','total_amount','total_collected','total_shipping','total_net_amount'));
    }
    }
     public function print_selected_drivers_close_selected($ids)
    {
              $myString = $ids;
$myArray = explode(',', $myString);
// print_r($myArray);
$factures = Facture::whereIn('id', $myArray)->with('customer')->orderBy('uid','ASC')->get();



//return $result;

 if(count($factures) == 0)
        {
            return Redirect::Back()->withErrors('No Factures selected');

        }
        else{

         $factures_update = Facture::whereIn('id', $myArray)->update(['is_printed'=>1]);
$details_update = Detail::whereIn('f_id', $myArray)->update(['is_printed'=>1]);

    }
    return Redirect()->route('driver_list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
