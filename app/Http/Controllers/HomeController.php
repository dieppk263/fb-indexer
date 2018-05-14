<?php

namespace App\Http\Controllers;

use App\Config;

class HomeController extends Controller
{
    public function index($id)
    {
        $filters = [
            'cho thuê',
            'khép kín',
        ];

        $posts = \DB::table('posts');
        $posts->where('id', '>=', $id);
        foreach ($filters as $filter) {
            $posts->where('message', 'LIKE', '%' . \utf8_encode($filter) . '%');
        }
        $result = $posts->get();

        $lastItem = $result->sortBy('id')->last();

        if (isset($lastItem->id)) {
            Config::where('key', 'last_read_post')->update([
                'value' => $lastItem->id,
            ]);
        }

        return \view('view', \compact('result'));
    }
}
