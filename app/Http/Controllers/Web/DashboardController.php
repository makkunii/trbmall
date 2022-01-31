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

    //ACCOUNTS
    public function accounts(Request $request)
    {
        $vaccount = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/accounts');

        if ($vaccount->successful())
        {

            $accountdata = $vaccount['Show'];

            return view('dashboard/accounts')->with(compact('accountdata'));

        }

        else
        {
            return view('dashboard/dashboard');
        }
    }


    //PRODUCT

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
                'subcategory_id' => 'required',
                'weight' => 'nullable',
                'length' => 'nullable',
                'height' => 'nullable',
                'status' => 'required'
            ]);

            $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/products/insert',[
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'subcategory_id' => $request->subcategory_id,
                'weight' => $request->weight,
                'length' => $request->length,
                'height' => $request->height,
                'status' => $request->status
            ]);

            if($insert->successful()) {

                return redirect()->back()->with('insertsuccess', 'Product saved');

            } else {
                return redirect()->back()->with('insertfailed', 'Product failed to save');
            }
    }

    public function updateproduct(Request $request)
    {

        $this->validate($request,[

            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'subcategory_id' => 'required',
            'weight' => 'required',
            'length' => 'required',
            'height' => 'required',
            'status'  => 'required'

       ]);

       $id = $request->input('id');
       
       $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/products/update',[

        'id' => $request->id,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'subcategory_id' => $request->subcategory_id,
        'weight' => $request->weight,
        'length' => $request->length,
        'height' => $request->height,
        'status' => 1
    ]);

        if ($update->successful())
        {
            return redirect()->back()->with('updatesuccess', 'Product updated');
        }

        else
        {
            return redirect()->back()->with('updatefailed', 'Product failed to update');
        }

    }

}