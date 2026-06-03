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
        try {
            $categoies = Category::whereNull('parent_id')->get();
            $allCategories = Category::with(relations: 'parent')->paginate(perPage: 5);
            return view('admin.categories', data: compact(var_name: ['categoies', 'allCategories']));
        } catch (\Exception $e) {
            return abort(404, "Something went wrong!");
        }
    }

    public function store(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request)
    {

        try {
            Category::where('id', $request->id)->orWhere('parent_id', $request->id)->delete();
            return response()->json([
                'success' => true,
                'msg' => 'Category Deleted Sucessfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }


    public function update(Request $request)
    {
        try {
            Category::where('id', $request->id)->update([
                'name' => $request->category_name,
                'parent_id' => $request->parent_id
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Category Updated Sucessfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
