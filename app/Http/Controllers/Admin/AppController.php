<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppData;
use App\Http\Requests\Admin\AppRequest;

class AppController extends Controller
{
    public function  index()
    {
        try{
           
            $data = AppData::first();
            return view('admin.dashboard', compact('data'));

        }
        catch(\Exception $e){
            return abort(404, "Something went wrong!");
        }
    }

    public function updateAppData(AppRequest $appRequest)
    {
        try{
            if(isset($appRequest->id)){
            AppData::where('id', $appRequest->id)->update(
                $appRequest->only([
                    'logo_first_text',
                    'logo_second_text',
                    'heading',
                    'location',
                    'email',
                    'phone',
                    'site_name',
                    'facebook',
                    'twitter',
                    'linkedin',
                    'instagram',
                    'youtube',
                    'contact_touch_text'
            
                ])
                );
            }
            else{
                AppData::create($appRequest->all());
            }
             
            return back()->with(['success' => 'Updated Successfully!']);

        }catch(\Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }
}
