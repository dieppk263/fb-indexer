<?php

namespace App\Console\Commands;

use App\Config;
use App\Group;
use App\Post;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class IndexGroupPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:index_group_posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index all post on groups and store to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $countPost = 0;
        foreach ($this->getGroupsID() as $group) {
            $client = new Client();
            $response = $client->request('GET', 'https://graph.facebook.com/v3.0/' . $group->group_id . '/feed', [
                'query' => [
                    'since'        => (!empty($group->last_post_updated)) ? $group->last_post_updated : Config::receive('default_updated_time'),
                    'limit'        => 100,
                    'access_token' => Config::receive('access_token'),
                ],
            ]);

            \Log::info('https://graph.facebook.com/v3.0/' . $group->group_id . '/feed', [
                'query' => [
                    'since'        => (!empty($group->last_post_updated)) ? $group->last_post_updated : Config::receive('default_updated_time'),
                    'limit'        => 100,
                    'access_token' => Config::receive('access_token'),
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $result = array_values(collect(json_decode($response->getBody())->data)->sortBy('updated_time')
                                                                                       ->toArray());

                foreach ($result as $post) {
                    $post = \collect($post)->toArray();

                    # check post
                    $checkPost = Post::where('post_id', $post['id'])->get();

                    if ($checkPost->isEmpty()) {
                        $post_updated = date('Y-m-d H:i:s', strtotime($post['updated_time']));

                        // Insert to posts
                        $post2 = new Post();
                        $post2->post_id = $post['id'];
                        $post2->message = isset($post['message']) ? utf8_encode($post['message']) : null;
                        $post2->story = isset($post['story']) ? $post['story'] : null;
                        $post2->updated_time = $post_updated;
                        $post2->group_id = $group->group_id;
                        $post2->save();

                        Group::where('group_id', $group->group_id)->update([
                            'last_post_updated' => $post_updated,
                            'last_updated'      => date('Y-m-d H:i:s', time()),
                        ]);

                        $countPost++;
                    }
                }
            }
        }

        \Log::info('Index: ' . $countPost . ' posts in ' . $this->getGroupsID()->count() . ' groups');
    }

    private function getGroupsID()
    {
        return Group::all(['group_id', 'last_post_updated']);
    }
}
