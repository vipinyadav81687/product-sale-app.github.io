<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppData extends Model
{
    use HasFactory;
    protected $fillable  = [
        'logo_first_text',
        'logo_second_text',
        'heading',
        'location',
        'email',
        'phone',
        'site_name',
        'facebook',
        'linkedin',
        'twitter',
        'instagram',
        'youtube',
        'contact_touch_text'

    ];
}
