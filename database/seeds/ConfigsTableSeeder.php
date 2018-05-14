<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            'default_updated_time' => date('Y-m-d H:i:s', strtotime('-2 days')),
            'access_token'         => 'EAAAAUaZA8jlABAMA9tyTj8wtkND5GL4MkngWSwQfmj0AoDwYewUwKBrhg8jvrlNUPaxQ60R2qjWG9xoSqwd5btps4HXQPWBZASb94KgW9FwjDE7RHgmJYTo1ecZBvVDrecmMYjN3AHfub3sRgbkCAGROqDnY2MYmWKzp8vHZCQZDZD',
            'last_read_post'       => 0,
        ];

        foreach ($configs as $key => $value) {
            DB::table('configs')->insert([
                'key'   => $key,
                'value' => $value,
            ]);
        }
    }
}
