<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = [
            0  => ['name' => 'All', 'channel_url' => '', 'color' => '#000000'],
            1  => ['name' => 'Code Review', 'channel_url' => 'code-review', 'color' => '#8CD362'],
            2  => ['name' => 'Elixir', 'channel_url' => 'elixir', 'color' => '#F7C953'],
            3  => ['name' => 'Eloquent', 'channel_url' => 'eloquent', 'color' => '#09D7C1'],
            4  => ['name' => 'Envoyer', 'channel_url' => 'envoyer', 'color' => '#F56857'],
            5  => ['name' => 'Forage', 'channel_url' => 'forge', 'color' => '#5DB3B7'],
            6  => ['name' => 'General', 'channel_url' => 'general-discussion', 'color' => '#4E89DA'],
            7  => ['name' => 'Guides', 'channel_url' => 'guides', 'color' => '#D51E22'],
            8  => ['name' => 'JavaScript', 'channel_url' => 'javascript', 'color' => '#9AD4E0'],
            9  => ['name' => 'Laravel', 'channel_url' => 'laravel', 'color' => '#F56857'],
            10 => ['name' => 'Lumen', 'channel_url' => 'lumen', 'color' => '#F9A97A'],
            11 => ['name' => 'Request', 'channel_url' => 'requests', 'color' => '#BB824E'],
            12 => ['name' => 'Servers', 'channel_url' => 'servers', 'color' => '#F9A97A'],
            13 => ['name' => 'Site FeedBack', 'channel_url' => 'site-improvements', 'color' => '#88AD48'],
            14 => ['name' => 'Spark', 'channel_url' => 'spark', 'color' => '#66ADD3'],
            15 => ['name' => 'Testing', 'channel_url' => 'testing', 'color' => '#DA5757'],
            16 => ['name' => 'Tips', 'channel_url' => 'tips', 'color' => '#837EB6'],
            17 => ['name' => 'Vue', 'channel_url' => 'vue', 'color' => '#3AB981'],
        ];

        foreach ($channels as $channel) {
            DB::table('channels')->insert([
                'name'        => $channel['name'],
                'channel_url' => $channel['channel_url'],
                'color'       => $channel['color'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }
}
