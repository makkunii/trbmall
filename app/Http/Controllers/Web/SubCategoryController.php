<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class SubCategoryController extends Controller
{

    //show sub category
    public function subcategory()
    {
        $vcategory = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/view/vcategory');

        if ($vcategory->successful())
        {
            
            $vsubcategory = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory');

            

            if ($vsubcategory->successful())
        {
            $vcategorydata = $vcategory['ShowCategory'];
            $subcategorydata = $vsubcategory['Show'];

            return view('dashboard/subcategory')->with(compact('vcategorydata','subcategorydata'));

        }

        else
        {
            return view('dashboard/dashboard');
        }

        }

        else
        {
            return view('dashboard/dashboard');
        }

    }

    //show category on select
    public function vcategory()
    {
        $vcategory = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/view/vcategory');

        if ($vcategory->successful())
        {

            $vcategorydata = $vcategory['ShowCategory'];

            return view('dashboard/subcategory')->with(compact('vcategorydata'));

        }

        else
        {
            return view('dashboard/dashboard');
        }
    }

    public function insertsubcategory(Request $request) {

        $this->validate($request,[
            'name' => 'required',
            'category_id' => 'required',
            'is_active' => 'required'
        ]);

        $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/insert',[
            'name' => $request->name,
            'category_id' => $request->category_id,
            'is_active' => $request->is_active
        ]);

        if($insert->successful()) {

            return redirect()->back()->with('insertsuccess', 'SubCategory saved');

        } else {
            return redirect()->back()->with('insertfailed', 'SubCategory failed to save');
        }
    }

    public function updatesubcategory(Request $request)
    {

        $this->validate($request,[

            'id' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'is_active' => 'required'

       ]);

       $id = $request->input('id');

       $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/subcategory/update',[

        'id' => $request->id,
        'name' => $request->name,
        'category_id' => $request->category_id,
        'is_active' => $request->is_active
    ]);

        if ($update->successful())
        {
            return redirect()->back()->with('updatesuccess', 'SubCategory updated');
        }

        else
        {
            return redirect()->back()->with('updatefailed', 'SubCategory failed to update');
        }

    }


} //end
