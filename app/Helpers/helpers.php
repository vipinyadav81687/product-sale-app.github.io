<?php

use App\Models\AppData;
use App\Models\Menu;


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
