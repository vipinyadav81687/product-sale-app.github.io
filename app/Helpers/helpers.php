<?php

use App\Models\AppData;

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