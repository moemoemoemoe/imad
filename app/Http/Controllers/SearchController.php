<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facture;
use App\Zone;
use App\Customer;
use App\Driver;
use App\Detail;
use Redirect;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('uid','ASC')->get();
        $zones = Zone::orderBy('uid','ASC')->get();
        $drivers = Driver::orderBy('uid','ASC')->get();

        return view('search.index',compact('customers','zones','drivers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search_action($tag, Request $r)
    {
        $the_tage = $tag;
        ////////////////////
        if($the_tage == 1)
        {
            $input = $r->input('uid');

//             $factures = Facture::orderBy('uid','ASC')->where('uid',$input)->get();
// return $factures;

            $details = Facture::with('customer')->with('zone')->where('uid',$input)->get();
        //return $details;

        
        if(count($details) == 0)
        {
            return Redirect::Back()->withErrors('No Factures Assigned To this UID');

        }
        else{
            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($details);$i++)
            {
                $total_amount = $total_amount  + $details[$i]->amount;
                $total_collected = $total_collected  + $details[$i]->collected;
                $total_shipping = $total_shipping  + $details[$i]->rate;
                $total_net_amount = $total_net_amount  + $details[$i]->net_amount;

            }
        
         return view('statistic.search_statis',compact('details','total_amount','total_collected','total_shipping','total_net_amount'));
    }

        }

        ///////////////////////
        if($the_tage == 2)
        {
            $input = $r->input('customer_id');
               $details = Facture::with('customer')->with('zone')->where('customer_id',$input)->get();
        //return $details;

        
        if(count($details) == 0)
        {
            return Redirect::Back()->withErrors('No Factures Assigned To this customer');

        }
        else{
            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($details);$i++)
            {
                $total_amount = $total_amount  + $details[$i]->amount;
                $total_collected = $total_collected  + $details[$i]->collected;
                $total_shipping = $total_shipping  + $details[$i]->rate;
                $total_net_amount = $total_net_amount  + $details[$i]->net_amount;

            }
        
         return view('statistic.search_statis',compact('details','total_amount','total_collected','total_shipping','total_net_amount'));
    }
        }

        if($the_tage == 3)
        {
            $input = $r->input('zone_id');
                $details = Facture::with('customer')->with('zone')->where('zone_id',$input)->get();
        //return $details;

        
        if(count($details) == 0)
        {
            return Redirect::Back()->withErrors('No Factures Assigned To this Zone');

        }
        else{
            $total_amount = 0;
            $total_collected = 0;
            $total_shipping = 0;
             $total_net_amount = 0;

            for($i=0;$i<count($details);$i++)
            {
                $total_amount = $total_amount  + $details[$i]->amount;
                $total_collected = $total_collected  + $details[$i]->collected;
                $total_shipping = $total_shipping  + $details[$i]->rate;
                $total_net_amount = $total_net_amount  + $details[$i]->net_amount;

            }
        
         return view('statistic.search_statis',compact('details','total_amount','total_collected','total_shipping','total_net_amount'));
    }

        }


        if($the_tage == 4)
        {
            $input = $r->input('driver_id');
 $details = Detail::with('facture')->with('customer')->with('zone')->where('driver_id',$input)->get();
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
    }
            
        }

        //
    }
 // public function autocomplete(Request $request)
 //    {
 //        $data = Facture::select("client_name")->where("client_name","LIKE","%{$request->input('query')}%")->get();
 //     //return $data;
 //        return response()->json($data);
 //    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
