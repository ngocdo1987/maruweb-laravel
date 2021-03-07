<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = "seo";
    protected $fillable = [
        'slug', 'meta_title', 'meta_desc', 'meta_keyword', 
        'model', 'model_id'
    ];
}
