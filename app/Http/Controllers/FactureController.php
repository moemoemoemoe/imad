<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facture;
use App\Customer;
use Validator;
use Redirect;
use App\Driver;
use App\Zone;
use App\Detail;
use App\Shipping;
use Session;


class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_facture()
    {
        $zones = Zone::orderBy('id','Asc')->get();
        $customers = Customer::OrderBy('id','Desc')->get();
        return view('factures.create_facture',compact('customers','zones'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_facture_save(Request $r)
    {
         $uid = $r->input('uid');

        $client_name = $r->input('client_name');
        $full_address = $r->input('full_address');
        $phone_number = $r->input('phone_number');
        $amount = $r->input('amount');
     
        $customer_id = $r->input('customer_id');
        $zone_id = $r->input('zone_id');
        $status = $r->input('status');
        $comment = $r->input('comment');
$fact_exist = Facture::where('uid',$uid)->count();
if($fact_exist == 0)
{

          $data = ['client_name' => $client_name,'full_address'=> $full_address,'phone_number' => $phone_number,'amount'=>$amount,'uid' => $uid];
          $rules = ['client_name' => 'required' ,'full_address' => 'required','phone_number'=> 'required','amount'=>'required', 'uid'=> 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v)->withInput($r->input());
            }
            else
            {
                $shipping = Shipping::where('customer_id',$customer_id)->where('zone_id',$zone_id)->get();
              
          
if(count($shipping) == 0)
{
     $ship = Shipping::where('customer_id',$customer_id)->get();

    $rate = $ship[0]->other_ship;


}
else
{
$rate = $shipping[0]->ship_one;

}



           

                if($comment == '')
                {
                    $comment = "No Comment Yet!!";
                }
                $facture = new Facture();
                $facture->uid = $uid;
                $facture->client_name = $client_name;
                $facture->full_address = $full_address;
                $facture->phone_number =$phone_number ;
                $facture->amount = $amount;
                $facture->customer_id = $customer_id;
                $facture->zone_id = $zone_id;
                $facture->status =$status ;
                $facture->comment = $comment;

                $facture->collected = $amount;
                $facture->rate =$rate;
                $facture->net_amount = $amount - $rate;
                 $facture->st = 0;
                $facture->save();
                return Redirect::Back()->with('success','Facture Uploaded Successfully');





            }
        }
        else{
            return Redirect::Back()->withErrors('ERROR DUPLICATE FACTURE NUMBER')->withInput($r->input());

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_facture()
    {   
        $factures = Facture::with('customer')->with('detail')->orderBy('uid','ASC')->get();
//return $factures;
     return view('factures.manage_facture',compact('factures','drivers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail_facture($fid)
   {
    $factures = Facture::where('uid',$fid)->get();
    //     $details_count = Detail::where('facture_id',$fid)->count();
      $drivers = Driver::orderBy('id','DESC')->get();
            //$zones = Zone::orderBy('id','DESC')->get();
            return view('factures.detail_facture',compact('fid','drivers','factures'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail_facture_assign($fid ,$c_id,$z_id, Request $r)
    {



        $driver_uid = $r->input('driver_id');
$factures_id = Facture::where('uid',$fid)->get();
$drivers_exist = Detail::where('facture_id',$fid)->get();
if(count($drivers_exist) == 0)
{


        //$zone_id = $r->input('zone_id');
        $detail = new Detail();
         $detail->f_id = $factures_id[0]->id;
        $detail->facture_id = $fid;
        $detail->driver_id = $driver_uid;
         $detail->customer_id = $c_id;
        $detail->zone_id = $z_id;
        $detail->save();

        $fact =Facture::findOrFail($factures_id[0]->id);
        $fact->st = 1;
        $fact->save();
        
        return Redirect::Back()->with('success','This Facture Is Assigned Successfully');
}
else{

      $detail =Detail::findOrFail($drivers_exist[0]->id);
      $detail->driver_id = $driver_uid;
      $detail->save();
       $fact =Facture::findOrFail($factures_id[0]->id);
        $fact->st = 1;
        $fact->save();

 return Redirect::Back()->with('success','This Facture Is changed Assigned Successfully');
}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function factures_stat()
    {
        $factures = Facture::with('customer')->orderBy('uid','ASC')->get();
        return view('factures.state',compact('factures'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_facture($id)
    {
         $factures = Facture::with('customer')->with('zone')->where('id',$id)->get();
         // return $factures;
         $zones = Zone::orderBy('id','Asc')->get();
        $customers = Customer::OrderBy('id','Desc')->get();
         return view('factures.edit_facture',compact('factures','zones','customers'));

    }
    public function edit_facture_save($id ,Request $r)
    {

 $uid = $r->input('uid');

        $client_name = $r->input('client_name');
        $full_address = $r->input('full_address');
        $phone_number = $r->input('phone_number');
        $amount = $r->input('amount');
     
        $customer_id = $r->input('customer_id');
        $zone_id = $r->input('zone_id');
        $status = $r->input('status');
        $comment = $r->input('comment');


          $data = ['client_name' => $client_name,'full_address'=> $full_address,'phone_number' => $phone_number,'amount'=>$amount,'uid' => $uid];
          $rules = ['client_name' => 'required' ,'full_address' => 'required','phone_number'=> 'required','amount'=>'required', 'uid'=> 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v)->withInput($r->input());
            }
            else
            {
                if($comment == '')
                {
                    $comment = "No Comment Yet!!";
                }
                $facture = Facture::findOrFail($id);
                $facture->uid = $uid;
                $facture->client_name = $client_name;
                $facture->full_address = $full_address;
                $facture->phone_number =$phone_number ;
                $facture->amount = $amount;
                $facture->customer_id = $customer_id;
                $facture->zone_id = $zone_id;
                $facture->status =$status;
                $facture->comment = $comment;
                $facture->save();
                return Redirect::Back()->with('success','Facture Updated Successfully');





            }
      
        
    }
    public function return_facture($id)
    {
$facture = Facture::findOrFail($id);
$facture->st = 2;
$facture->save();
                return Redirect::Back()->with('success','Facture As Return');


    }
    public function paid_facture($id)
    {
        $facture = Facture::findOrFail($id);
$facture->st = 3;
$facture->save();
                return Redirect::Back()->with('success','Facture As Paid');


        
    }
    public function werehouse()
    {
        $factures = Facture::with('customer')->orderBy('uid','ASC')->get();
        return view('factures.werhouse',compact('factures'));
    
    }
     public function werhouse_checkout(Request $r)
    {
              $drivers = Driver::orderBy('id','DESC')->get();

       $check_box = $r->input('check_box_1');
             Session::put('check_box', $check_box);

       // for($i=0;$i<count($check_box);$i++)
       //       {
                
    
       //        echo $check_box[$i].'/////';
       //      }

       return view('factures.werhouse_checkout',compact('drivers'));
    
    }
    public function werhouse_checkout_assign(Request $r)
    {

     $driver_uid = $r->input('driver_id');

        $check_box  = Session::get('check_box');
        for($i=0;$i<count($check_box);$i++)
             {
$drivers_exist = Detail::where('f_id',$check_box[$i])->get();
$factures = Facture::where('id',$check_box[$i])->get();

if(count($drivers_exist) == 0)
{
     $detail = new Detail();
         $detail->f_id = $check_box[$i];
        $detail->facture_id = $factures[0]->uid;
        $detail->driver_id = $driver_uid;
         $detail->customer_id = $factures[0]->customer_id;
        $detail->zone_id = $factures[0]->zone_id;
        $detail->save();

        $fact =Facture::findOrFail($check_box[$i]);
        $fact->st = 1;
        $fact->save();
        
       

}
else{
  $detail =Detail::findOrFail($check_box[$i]);
      $detail->driver_id = $driver_uid;
      $detail->save();
       $fact =Facture::findOrFail($check_box[$i]);
        $fact->st = 1;
        $fact->save();


}

         
            }

 return Redirect::Back()->with('success','Factures Is Assigned Successfully');


    
    
}
}