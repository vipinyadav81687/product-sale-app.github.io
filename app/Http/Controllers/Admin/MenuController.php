<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    //
    public function index()
    {
        try{
            $parentMenus = Menu::whereNull('parent_id')->get();
            return view('admin.menus', compact('parentMenus'));
        }
        catch(\Exception $e){
            return abort(404, "Something went wrong!");
        }
    }

    public function store(Request $request)
    {
        try{
            Menu::create(
             $request->only([
                    'name',
                    'url',
                    'is_external',
                    'position',
                    'parent_id',
            
            
             ])
            );
            return response()->json([
                'success' => true,
                'msg'=> 'Menu Created Sucessfully!'
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
