<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class SubCategoryController extends Controller
{
    public function subcategory()
    {
        $vsubcategory = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory');

        if ($vsubcategory->successful())
        {

            $subcategorydata = $vsubcategory['Show'];

            return view('dashboard/subcategory')->with(compact('subcategorydata'));

        }

        else
        {
            return view('dashboard/dashboard');
        }
    }

    public function insertsubcategory(Request $request) {

        $this->validate($request,[
            'name' => 'required',
            'is_active' => 'required'
        ]);

        $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/insert',[
            'name' => $request->name,
            'is_active' => $request->is_active
        ]);

        if($insert->successful()) {

            return redirect()->back()->with('insertsuccess', 'SubCategory saved');

        } else {
            return $insert;
            //return redirect()->back()->with('insertfailed', 'SubCategory failed to save');
        }
    }
}
