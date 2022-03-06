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
        $vcategory = Http::accept('application/json')->get('https://dev.trbmall.trbexpressinc.net/api/dashboard/category'); //call api for category

        if ($vcategory->successful()) // CONDITION IF API ABOVE RETURNED SOME DATA
        {

            $categorydata = $vcategory['Show']; // $categorydata IS A VARIABLE USED TO TRANSFER DATA CAME FROM $vcategory(VARIABLE USED TO CALL API LINK ABOVE)

            // categorydata BELOW IS USED TO TRANSFER $vcategorydata ABOVE TO THE BLADENAME SPECIFIED ON RETURN VIEW
            return view('dashboard/category')->with(compact('categorydata'));

        }

        else
        {
            return view('dashboard/dashboard'); // ERROR HANDLING RETURN THIS PAGE IF QUERY DIDNT RETURN DATA
        }
    }

    public function insertcategory(Request $request) {

        $this->validate($request,[
            'name' => 'required', // USE REQUIRED IF FIELD IS REQUIRED ON FORM AND DB
            'is_active' => 'required'
        ]);

        $insert = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/category/insert',[ //call api
            'name' => $request->name, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
            'is_active' => $request->is_active
        ]);

        if($insert->successful()) {

            return redirect()->back()->with('insertsuccess', 'Category saved'); //redirect to the page and alert will pop up

        } else {
            return redirect()->back()->with('insertfailed', 'Category failed to save'); //error handling and redirect to the page and alert will pop up
        }
    }

    public function updatecategory(Request $request)
    {

        $this->validate($request,[

            'id' => 'required',
            'name' => 'required',
            'is_active' => 'required'

       ]);

       $id = $request->input('id'); // CALL ID INPUTFIELD NAME FOR ID(MIGHT BE HIDDEN IF ID ISNT DISPLAYED ON BLADE)

       $update = Http::accept('application/json')->post('https://dev.trbmall.trbexpressinc.net/api/dashboard/category/update',[

        'id' => $request->id, // $request->(); is USED TO CALL INPUTFIELD/SESSION/COOKIES/ETC
        'name' => $request->name,
        'is_active' => $request->is_active
    ]);

        if ($update->successful())
        {
            return redirect()->back()->with('updatesuccess', 'Category updated'); //redirect to the page and alert will pop up
        }

        else
        {
            return redirect()->back()->with('updatefailed', 'Category failed to update'); //error handling and redirect to the page and alert will pop up
        }

    }
}
