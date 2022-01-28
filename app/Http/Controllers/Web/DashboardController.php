<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard/dashboard');
    }

    public function accounts()
    {
        return view('dashboard/accounts');
    }


    public function products(Request $request)
    {

        $vproduct = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/products');

        if ($vproduct->successful())
        {

            $productdata = $vproduct['Show'];

            return view('dashboard/products')->with(compact('productdata'));

        }

        else
        {

            return view('dashboard/dashboard');

        }

    }

    public function insertproduct(Request $request) {

            $this->validate($request,[
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'weight' => 'nullable',
                'length' => 'nullable',
                'height' => 'nullable',
                'status' => 'required'
            ]);

            $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/products/insert',[
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'weight' => $request->weight,
                'length' => $request->length,
                'height' => $request->height,
                'status' => $request->status
            ]);

            if($insert->successful()) {

                return redirect()->route('dashboard/products');

            } else {
                return view('dashboard/dashboard');
            }
    }

    public function updateproduct(Request $request)
    {

        $this->validate($request,[

            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'length' => 'required',
            'height' => 'required',
            'status'  => 'required'

       ]);

       $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/products/update',[

        //your data

        'id'=>$request->id,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'weight' => $request->weight,
        'length' => $request->length,
        'height' => $request->height,
        'status' => $request->status
    ]);

        if ($update->successful())
        {

            return redirect()->route('dashboard/products');

        }

        else
        {

            return view('dashboard/dashboard');

        }

    }

}