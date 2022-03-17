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

        $provinces = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/province/all'); //call api
        if($provinces->successful()){ // CONDITION IF API ABOVE RETURNED SOME DATA
                $province = $provinces['Provinces'];

                //here we assign data promo as null soo that we can do a validation
                $datapromo = null;
                // province and datapromo BELOW IS USED TO TRANSFER $province & $datapromo ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW
                return view('mall/checkout')->with(compact('province','datapromo'));
        }
        else{
            return view('mall/checkout'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
        }

    }

    public function getCityz(Request $request){
            $province = $request->post('province');
            $response = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/city/'.$province); //call api

            $city = $response['City/Municipality'];
            $html='<option value="null" selected disabled> Select City/Municipality </option>';
            // display cities based on selected province using foreach loop
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
            // display barangay based on selectd city using foreach loop
            foreach($brgy as $brgys){
                $html.='<option value="'.$brgys['brgyDesc'].'">'.$brgys['brgyDesc'].'</option>';
            }
            echo $html;
	}

    public function checkpromo(Request $request) {
        $provinces = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/location/province/all');
        $province = $provinces['Provinces'];

        //here we assign the status into null
        $PromoStatus = null;


        //here it checks if the promo exist
        if (!empty($request->promo_name)) {
           $datapromo = Promo::where('name', $request->promo_name)->first();

            //here we check if the promo is expired
            // and do a conditon if its expired
            $expired = $datapromo->expired_at;
            $date = Carbon::now()->toDateTimeString();
            if($date <= $expired) {
                $PromoStatus = "Active";
                //now we change the value of promo status to active if its valid
                return view('mall/checkout')->with(compact('province','datapromo','PromoStatus'));
            }
            else {
                $datapromo = null;
                //else we return null
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

        $this->validate($request,[ // THIS IS USED FOR FIELD VALIDATION (IF FIELD IS BLANK OR INVALID PAGE WILL REFRESH)
            'first_name'=> 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
            'last_name'=> 'required',
            'province'=> 'required',
            'city'=> 'required',
            'brgy'=> 'required',
            'phone'=> 'required',
            'email'=> 'required',
            'promo'=> 'nullable', // USE NULLABLE IF FIELD IS NOT REQUIRED ON FORM AND DB
            'subtotal'=>'required',
            'total'=>'required',
            'products'=>'required',
            'quantity'=>'required',
            'status' => 'required'
        ]);

        $products = $request->session()->get('data'); //get data using session



        foreach($products as $product) //get product id, product quantity and product price of selected products
        {


            $prod_id = $products['product_id'];
            $productss_id = implode(',', $prod_id);

            $prod_qty = $products['product_qty'];
            $productss_qty = implode(',', $prod_qty);

            $subtotal = $products['product_price'];
            $subtotals = implode(',', $subtotal);


             \Cart::remove($request->prod_id['product_id']);


        }


        $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/orders/insertorder',[ //call api
           'first_name'=> $request->first_name, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
           'last_name'=> $request->last_name,
           'province'=> $request->province,
           'city'=> $request->city,
           'brgy'=> $request->brgy,
           'phone'=> $request->phone,
           'email'=> $request->email,
           'promo'=> $request->promo,
           'subtotal'=> '['.$subtotals.']',
           'total'=> $request->total,
           'products'=> '['.$productss_id.']',
           'quantity'=> '['.$productss_qty.']',
           'status' => $request->status
        ]);



        if($insert->successful()) {

            return redirect('/home')->with('insertsuccess', 'Products ordered successfully'); //redirect to home when products ordered successfully

        } else {
            return $insert; //display error
        }


}


} //end
