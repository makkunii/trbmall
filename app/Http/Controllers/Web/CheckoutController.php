<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Promo;
use Carbon\Carbon;
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
                $datapromo = null;
                return view('mall/checkout')->with(compact('province','datapromo'));
        }
        else{
            return view('mall/checkout');
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

    public function checkpromo(Request $request) {
        $provinces = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/province/all');
        $province = $provinces['Provinces'];
        $PromoStatus = null;

        if (!empty($request->promo_name)) {
           $datapromo = Promo::where('name', $request->promo_name)->first();

            $expired = $datapromo->expired_at;
            $date = Carbon::now()->toDateTimeString();
            if($date <= $expired) {
                $PromoStatus = "Active";
                return view('mall/checkout')->with(compact('province','datapromo','PromoStatus'));
            }
            else {
                $datapromo = null;
                return view('mall/checkout')->with(compact('province','datapromo','PromoStatus'));
            }
        }

        else {
            $datapromo = null;
            return view('mall/checkout')->with(compact('province','datapromo','PromoStatus'));
        }


        // $checkpromo = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/promo/check/'.$id['id']);
        //     if( $checkpromo->successful()) {
        //         $data = $checkpromo['Show'];
        //         return view('/mall/checkout')->with(compact('data'));
        //     } else {
        //         return view('/mall/checkout');
        //     }
    }

    public function insertorder(Request $request) {

        $this->validate($request,[
            'first_name'=> 'required',
            'last_name'=> 'required',
            'province'=> 'required',
            'city'=> 'required',
            'brgy'=> 'required',
            'phone'=> 'required',
            'email'=> 'required',
            'promo'=> 'nullable',
            'subtotal'=>'required',
            'total'=>'required',
            'products'=>'required'
        ]);

        $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/insertorder',[
           'first_name'=> $request->first_name,
           'last_name'=> $request->last_name,
           'province'=> $request->province,
           'city'=> $request->city,
           'brgy'=> $request->brgy,
           'phone'=> $request->phone,
           'email'=> $request->email,
           'promo'=> $request->promo,
           'subtotal'=> $request->subtotal,
           'total'=> $request->total,
           'products'=> $request->products
        ]);



        if($insert->successful()) {

            return redirect('/home')->with('insertsuccess', 'Products ordered successfully');

        } else {
            return redirect()->back()->with('insertfailed', 'Products failed to order');
        }
}


} //end
