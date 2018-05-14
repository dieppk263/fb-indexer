<?php

namespace App\Console\Commands;

use App\Config;
use Illuminate\Console\Command;
use NNV\OneSignal\API\Notification;
use NNV\OneSignal\OneSignal;

class PushNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:push_notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push notifications if new posts';

    private $oneSignal;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->oneSignal = new OneSignal(env("ONESIGNAL_AUTH_KEY"), env("ONESIGNAL_APP_ID"), env("ONESIGNAL_APP_REST_KEY"));
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $filters = [
            'cho thuê',
            'khép kín',
        ];

        $posts = \DB::table('posts');
        $posts->where('id', '>', Config::receive('last_read_post'));
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

        foreach ($result as $post) {
            $oneSingalNotification = new Notification($this->oneSignal);
            $notificationData = [
                "included_segments" => ["All"],
                "contents"          => [
                    "vi" => substr(utf8_decode($post->message), 0, 128),
                ],
                "headings"          => [
                    "vi" => 'Có người cho thuê phòng trọ mới',
                ],
                "web_buttons"       => [
                    [
                        "id"   => "readmore-button",
                        "text" => "Read more",
                        "url"  => "https://www.facebook.com/" . $post->post_id,
                    ],
                ],
                "isChromeWeb"       => true,
            ];

            $notification = $oneSingalNotification->create($notificationData);

            \Log::info('Push notice', \collect($notification)->toArray());
        }
    }
}
