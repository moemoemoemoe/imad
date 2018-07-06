<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Validator;
use Redirect;
use App\Zone;
use App\Shipping;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_customers()
    {
        $customers = Customer::orderBy('id','DESC')->with('rate')->get();
        
        $zones = Zone::orderBy('id','ASC')->get();


        return view('customers.index',compact('customers','zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_customers_save(Request $r)
    {

          $uid = $r->input('uid');

         $name = $r->input('name');
            $address= $r->input('address');
            $phone_number = $r->input('phone_number');

             $zone = $r->input('zone');
               $ship_one = $r->input('ship_one');
               $other_ship = $r->input('other_ship');
            //$rate = $r->input('rate');
$cust_exist = Customer::where('uid',$uid)->count();
if($cust_exist > 0)
{
     return Redirect::Back()->withErrors('ERROR DUPLICAT CUSTOMER ID')->withInput($r->input());
}
             $data = ['name' => $name,'address'=> $address,'phone_number' => $phone_number,'uid'=>$uid,'zone'=>$zone ,'ship_one'=>$ship_one , 'other_ship' => $other_ship];

            $rules = ['name' => 'required' ,'address' => 'required','phone_number'=> 'required','uid'=> 'required', 'zone' =>'required','ship_one'=>'required','other_ship' =>'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v)->withInput($r->input());
            }else
            {
                $cust = new Customer();
                 $cust->uid = $uid;
                $cust->name = $name;
                $cust->address = $address;
                $cust->phone_number = $phone_number;
                //$cust->rate = $rate;
                $cust->status = 0;
                $cust->save();
  for($i=0;$i<count($zone);$i++)
             {
                
    
                $shipping = new Shipping();
                $shipping->customer_id= $cust->id;
                $shipping->zone_id = $zone[$i];
                $shipping->ship_one = $ship_one;
                $shipping->other_ship =$other_ship;

                $shipping->save();
            }

      return Redirect::Back()->with('success', 'Customer added successfully');

 
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_customer($id)
    {
        $customers = Customer::findOrFail($id);
        $zones = Zone::orderBy('id','ASC')->get();
        $shipping = Shipping::where('customer_id',$id)->get();
        return view('customers.update_cust',compact('customers','zones','shipping'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_customer_save($id,Request $r)
    {
        $uid = $r->input('uid');
         $name = $r->input('name');
            $address= $r->input('address');
            $phone_number = $r->input('phone_number');
            $zone = $r->input('zone');
               $ship_one = $r->input('ship_one');
               $other_ship = $r->input('other_ship');

             $data = ['name' => $name,'address'=> $address,'phone_number' => $phone_number,'uid'=> $uid,'zone'=>$zone ,'ship_one'=>$ship_one , 'other_ship' => $other_ship];

            $rules = ['name' => 'required' ,'address' => 'required','phone_number'=> 'required','uid'=> 'required', 'zone' =>'required','ship_one'=>'required','other_ship' =>'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v)->withInput($r->input());
            }else
            { $sh = Shipping::where('customer_id',$id);
$sh->delete();
                $cust =  Customer::findOrFail($id);
                 $cust->uid = $uid;

                $cust->name = $name;
                $cust->address = $address;
                $cust->phone_number = $phone_number;
               $cust->save();
              
                for($i=0;$i<count($zone);$i++)
             {
                
    
                $shipping = new Shipping();
                $shipping->customer_id= $cust->id;
                $shipping->zone_id = $zone[$i];
                $shipping->ship_one = $ship_one;
                $shipping->other_ship =$other_ship;

                $shipping->save();
            }
      return Redirect::Back()->with('success', 'Customer updated successfully');

 
            }
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_customer($id)
    {
         $customer = Customer::findOrFail($id);
      $customer->delete();
  
      return Redirect::Back()->with('success' , 'Customer was Deleted successfuly!!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customer_list()
    {
        $customers = Customer::orderBy('id','DESC')->get();
        return view('customers.customer_list',compact('customers'));
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
