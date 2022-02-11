<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function checkout()
    {
        
        $provinces = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/province/all');

        if($provinces->successful()){

            $province = $provinces['Provinces'];

            return view('mall/checkout')->with(compact('province'));
        }

    }

    public function getCityz(Request $request){


        $province = $request->post('province');

        $response = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/city/'.$province);

        $city = $response['City/Municipality'];

        $html='<option selected disabled> Select City/Municipality </option>';

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

} //end