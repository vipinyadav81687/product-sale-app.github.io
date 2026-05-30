<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    public function index()
    {
    try{
        $banners = Banner::paginate(perPage: 5);
          return view('admin.banners',data: compact(var_name: ['banners']));
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
          'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:20480',
          'heading' => 'required'
         ]);
             
         $fileName = '';
         if($request->hasFile('image')){
          $file = $request->file('image');
         $fileName = time().'_'.$file->getClientOriginalName();
         $destinationPath = public_path('uploads');
         $file->move($destinationPath,$fileName);

         $fileName = 'uploads/'.$fileName;
         }

         Banner::create([
          'image' => $fileName ,
          'paragraph' => $request->paragraph,
          'heading' => $request->heading,
          'btn_text'=> $request->btn_text,
          'link' => $request->link,
          'status' => $request->status
         ]);

        return response()->json([
            'success' => true,
            'msg' => 'Banner Added Successfully!'
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

     public function destroy(Request $request)
    {
            
        try{
            Banner::where('id', $request->id)->delete();
            return response()->json([
                'success' => true,
                'msg'=> 'Banner Deleted Sucessfully!'  
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'msg'=> $e->getMessage()
            ]);
        }
    
    }

     public function update(Request $request)
    {
        try{

         $request->validate([
            'id' => 'required',
          'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:20480',
          'heading' => 'required'
         ]);

           $data = [
            'paragraph' => $request->paragraph,
            'heading' => $request->heading,
            'btn_text' => $request->btn_text,
            'link' => $request->link,
            'status' => $request->status
           ];
             
         $fileName = '';
         if($request->hasFile('image')){
          $file = $request->file('image');
         $fileName = time().'_'.$file->getClientOriginalName();
         $destinationPath = public_path('uploads');
         $file->move($destinationPath,$fileName);

         $fileName = 'uploads/'.$fileName;
         $data['image'] = $fileName;
         }
       

         Banner::where('id', $request->id)->update($data);
          
            return response()->json([
                'success' => true,
                'msg'=> 'Banner Updated Sucessfully!'
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
