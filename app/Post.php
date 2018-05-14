<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'message',
        'story',
        'updated_time',
        'group_id',
    ];
}
