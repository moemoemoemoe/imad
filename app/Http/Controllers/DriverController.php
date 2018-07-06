<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Driver;
use App\Zone;
use Validator;
use Redirect;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_driver()
    {
         $drivers = Driver::orderBy('id','DESC')->get();

        return view('drivers.index',compact('drivers'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_driver_save(Request $r)
    {
          $uid = $r->input('uid');
         $name = $r->input('name');
           
            $phone_number = $r->input('phone_number');
           
$driver_exist = Driver::where('uid',$uid)->count();
if($driver_exist > 0)
{
     return Redirect::Back()->withErrors('ERROR DUPLICAT DRIVER ID')->withInput($r->input());
}
             $data = ['name' => $name,'phone_number' => $phone_number,'uid' => $uid];

            $rules = ['name' => 'required' ,'phone_number'=> 'required','uid' => 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v)->withInput($r->input());
            }else
            {
                $dri = new Driver();
               
                $dri->uid = $uid;
                 $dri->name = $name;
                $dri->phone_number = $phone_number;
                
               
                $dri->save();
      return Redirect::Back()->with('success', 'Driver added successfully');

 
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_driver($id)
    {
        
    $drivers = Driver::findOrFail($id);
        return view('drivers.update_dri',compact('drivers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_driver_save($id,Request $r)
    {
          $uid = $r->input('uid');
       $name = $r->input('name');
           
            $phone_number = $r->input('phone_number');
           

             $data = ['name' => $name,'phone_number' => $phone_number,'uid' => $uid];

            $rules = ['name' => 'required' ,'phone_number'=> 'required','uid' => 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v)->withInput($r->input());
            }else
            {
                $dri =  Driver::findOrFail($id);
                $dri->uid = $uid;
                $dri->name = $name;
                $dri->phone_number = $phone_number;
               
           
                $dri->save();
      return Redirect::Back()->with('success', 'Driver updated successfully');

 
            }
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_driver($id)
    {
       $dri = Driver::findOrFail($id);
      $dri->delete();
  
      return Redirect::Back()->with('success' , 'Driver was Deleted successfuly!!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage_zones()
    {
        $zones = Zone::orderBy('id','ASC')->get();
        return view('zones.index',compact('zones'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage_zones_save(Request $r)
    {
         $uid = $r->input('uid');
        $name = $r->input('name');
           
            

             $data = ['name' => $name,'uid'=>$uid];

            $rules = ['name' => 'required','uid' => 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v)->withInput($r->input());
            }else
            {
                $zone = new Zone();
                $zone->uid = $uid;
                $zone->name = $name;
               
              
                
               
                $zone->save();
      return Redirect::Back()->with('success', 'Zone added successfully');

 
            }
    }
     public function delete_zone($id)
    {
         $zone = Zone::findOrFail($id);
      $zone->delete();
  
      return Redirect::Back()->with('success' , 'zone was Deleted successfuly!!');
    }
    
  public function driver_list()
    {
        $drivers = Driver::orderBy('id','DESC')->get();
        return view('drivers.driver_list',compact('drivers'));
    }
}
