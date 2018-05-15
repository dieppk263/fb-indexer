<?php

namespace App\Http\Controllers;

use App\Config;
use App\Group;
use GuzzleHttp\Client;

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

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function myGroups()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://graph.facebook.com/v3.0/me/groups', [
            'query' => [
                'limit'        => 1000,
                'access_token' => Config::receive('access_token'),
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody())->data;

            foreach ($result as $group) {
                if (strpos(strtolower($group->name), 'trọ')) {
                    $check = Group::where('group_id', $group->id)->get();
                    if ($check->isEmpty()) {
                        $add = new Group();
                        $add->group_id = $group->id;
                        $add->save();
                    }
                }
            }
        }
    }
}
