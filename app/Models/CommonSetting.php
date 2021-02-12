<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonSetting extends Model
{
    protected $fillable = [
        'setting_name', 'setting_human_name', 'setting_value', 'display_order'
    ];
}
