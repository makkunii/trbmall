<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    //CATEGORY
    public function category(Request $request)
    {
        $vcategory = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/category');

        if ($vcategory->successful())
        {

            $categorydata = $vcategory['Show'];

            return view('dashboard/category')->with(compact('categorydata'));

        }

        else
        {
            return view('dashboard/dashboard');
        }
    }

    public function insertcategory(Request $request) {

        $this->validate($request,[
            'name' => 'required',
            'is_active' => 'required'
        ]);

        $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/category/insert',[
            'name' => $request->name,
            'is_active' => $request->is_active
        ]);

        if($insert->successful()) {

            return redirect()->back()->with('insertsuccess', 'Category saved');

        } else {
            return redirect()->back()->with('insertfailed', 'Category failed to save');
        }
    }

    public function updatecategory(Request $request)
    {

        $this->validate($request,[

            'id' => 'required',
            'name' => 'required',
            'is_active' => 'required'

       ]);

       $id = $request->input('id');

       $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/category/update',[

        'id' => $request->id,
        'name' => $request->name,
        'is_active' => $request->is_active
    ]);

        if ($update->successful())
        {
            return redirect()->back()->with('updatesuccess', 'Category updated');
        }

        else
        {
            return redirect()->back()->with('updatefailed', 'Category failed to update');
        }

    }
}
