<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variation;
use App\Models\VariationValue;
use Illuminate\Http\Request;


class VariationController extends Controller
{
    //
     public function index()
    {
        try{
            $variations = Variation::with('values')->paginate(5);
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

     public function variationValueStore(Request $request)
    {
        try{

            $request->validate([
             'variation_id' => 'required',
             'value' => 'required'

            ]);

            $isExist = VariationValue::where('variation_id',$request->variation_id)
            ->whereRaw('LOWER(value) = ?',[strtolower($request->value)])
            ->first();

            if($isExist){
            return response()->json([
                'success' => false,
                'msg'=> $request->value.' Variation Value already Created!'
            ]);
           }

           VariationValue::create([
        'variation_id' => $request->variation_id,
        'value' => $request->value
           ]);
            return response()->json([
                'success' => true,
                'msg'=> 'Variation value Created Sucessfully!'
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg'=> $e->getMessage()
            ]);
        }
    }


    public function variationValueDestroy(Request $request)
    {
        try{

            $request->validate([
             'id' => 'required'
            ]);

            VariationValue::where('id',$request->id)->delete();

            return response()->json([
                'success' => true,
                'msg'=> 'Variation Value Deleted Sucessfully!'
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
