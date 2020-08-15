<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $casts = [
      'created_at' => 'datetime:F j, Y, g:i a'
    ];
}
