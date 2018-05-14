<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $primaryKey = null;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function receive($key)
    {
        $config = static::where('key', $key)->first();

        return $config->value;
    }
}
