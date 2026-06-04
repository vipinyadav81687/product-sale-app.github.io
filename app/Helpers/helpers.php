<?php

use App\Models\AppData;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Variation;

function getAppData($select)
{
    $sendData = '';
     $exists = AppData::select($select)->first();
     if($exists)
     {
        $sendData = $exists->$select;
     }
     return $sendData;

}

function getMenu($position)
{
   try{
 $menus = Menu::where('position', $position)->whereNull('parent_id')->orderBy('id')->get();
   return $menus;
   }
   catch(\Exception $e){
      return [];
   }
}

function getAllCategories()
{
   try{
     $getAllCategories = Category::whereNull('parent_id')->with('children')->get();
   return $getAllCategories;
   }
   catch(\Exception $e){
      return [];
   }
}

function getBanners()
{
   try{
     $banners = Banner::where('status',1)->get();
   return $banners;
   }
   catch(\Exception $e){
      return [];
   }
}

function getVariations()
{
   try{
     $variations = Variation::with('values')->get();
   return $variations;
   }
   catch(\Exception $e){
      return [];
   }
}