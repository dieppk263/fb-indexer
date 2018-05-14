<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'last_post_updated',
        'last_updated',
    ];
}
