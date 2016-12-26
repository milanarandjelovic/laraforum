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
            0  => ['name' => 'All', 'channel_url' => 'all', 'channel_icon' => 'fa fa-bolt'],
            1  => ['name' => 'Code Review', 'channel_url' => 'code-review', 'channel_icon' => 'fa fa-bolt'],
            2  => ['name' => 'Elixir', 'channel_url' => 'elixir', 'channel_icon' => 'fa fa-bolt'],
            3  => ['name' => 'Eloquent', 'channel_url' => 'eloquent', 'channel_icon' => 'fa fa-bolt'],
            4  => ['name' => 'Envoyer', 'channel_url' => 'envoyer', 'channel_icon' => 'fa fa-bolt'],
            5  => ['name' => 'Forage', 'channel_url' => 'forge', 'channel_icon' => 'fa fa-bolt'],
            6  => ['name' => 'General', 'channel_url' => 'general-discussion', 'channel_icon' => 'fa fa-bolt'],
            7  => ['name' => 'Guides', 'channel_url' => 'guides', 'channel_icon' => 'fa fa-bolt'],
            8  => ['name' => 'JavaScript', 'channel_url' => 'javascript', 'channel_icon' => 'fa fa-bolt'],
            9  => ['name' => 'Laravel', 'channel_url' => 'laravel', 'channel_icon' => 'fa fa-bolt'],
            10 => ['name' => 'Lumen', 'channel_url' => 'lumen', 'channel_icon' => 'fa fa-bolt'],
            11 => ['name' => 'Request', 'channel_url' => 'requests', 'channel_icon' => 'fa fa-bolt'],
            12 => ['name' => 'Servers', 'channel_url' => 'servers', 'channel_icon' => 'fa fa-bolt'],
            13 => ['name' => 'Site FeedBack', 'channel_url' => 'site-improvements', 'channel_icon' => 'fa fa-bolt'],
            14 => ['name' => 'Spark', 'channel_url' => 'spark', 'channel_icon' => 'fa fa-bolt'],
            15 => ['name' => 'Testing', 'channel_url' => 'testing', 'channel_icon' => 'fa fa-bolt'],
            16 => ['name' => 'Tips', 'channel_url' => 'tips', 'channel_icon' => 'fa fa-bolt'],
            17 => ['name' => 'Vue', 'channel_url' => 'vue', 'channel_icon' => 'fa fa-bolt'],
        ];

        foreach ($channels as $channel) {
            DB::table('channels')->insert([
                'name'         => $channel['name'],
                'channel_url'  => $channel['channel_url'],
                'channel_icon' => $channel['channel_icon'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }
    }
}
