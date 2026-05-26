<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        try{
         $categoies = Category::whereNull('parent_id')->get();
          return view('admin.categories',compact('categoies'));
        }
        catch(\Exception $e)
        {
          return abort(404, "Something went wrong!");  
        }
    }

     public function store(Request $request)
    {
        try{
         $request->validate([
          'category_name' => 'required|unique:categories,name',
          'parent_id' => 'nullable|exists:categories,id'
         ]);
             
         Category::create([
          'name' => $request->category_name,
          'parent_id' => $request->parent_id
         ]);

        return response()->json([
            'success' => true,
            'msg' => 'Category Added Successfully!'
        ]);
      
        }
        catch(\Exception $e)
        {
         return response()->json([
            'success' => false,
            'msg' => $e->getMessage()
        ]);
        }
    }
}
