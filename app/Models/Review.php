<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['rating', 'comment', 'post_id', 'user_id'];
}
