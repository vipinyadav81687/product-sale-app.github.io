<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variation;
use Illuminate\Http\Request;


class VariationController extends Controller
{
    //
     public function index()
    {
        try{
            $variations = Variation::paginate(5);
            return view('admin.variation', compact('variations'));
        }
        catch(\Exception $e){
            return abort(404, "Something went wrong!");
        }
    }

     public function store(Request $request)
    {
        try{

            $request->validate([
             'name' => 'required|unique:variations,name'
            ]);
            Variation::create([
               'name' => $request->name
            ]);
            return response()->json([
                'success' => true,
                'msg'=> 'Variation Created Sucessfully!'
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg'=> $e->getMessage()
            ]);
        }
    }
}
