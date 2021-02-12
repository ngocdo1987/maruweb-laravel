<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'admin_id', 'menu', 'action_type', 'ref_id'
    ];

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }
}
