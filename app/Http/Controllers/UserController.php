<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function user()

    {
        $provinces = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/province/all');
        if($provinces->successful()){
                $province = $provinces['Provinces'];


                return view('users/user')->with(compact('province'));
        }
        else{
            return view('users/user');
        }

    }

    public function getCityz(Request $request){
        $province = $request->post('province');
        $response = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/city/'.$province);

        $city = $response['City/Municipality'];
        $html='<option value="null" selected disabled> Select City/Municipality </option>';
        foreach($city as $cities){
            $html.='<option value="'.$cities['citymunDesc'].'">'.$cities['citymunDesc'].'</option>';
        }
        echo $html;
}

public function getBrgyz(Request $request){
        $city = $request->post('city');
        $province = $request->post('province');
        $response = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/brgy/'.$city.'/'.$province);

        $brgy = $response['barangay'];

        $html='<option selected disabled> Select Brgy </option>';
        foreach($brgy as $brgys){
            $html.='<option value="'.$brgys['brgyDesc'].'">'.$brgys['brgyDesc'].'</option>';
        }
        echo $html;
}


public function purchase()

{

        return view('users/purchase');


}


}
