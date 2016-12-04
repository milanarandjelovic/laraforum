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
            0  => ['name' => 'All', 'color' => '#000000'],
            1  => ['name' => 'Code Review', 'color' => '#8CD362'],
            2  => ['name' => 'Elixir', 'color' => '#F7C953'],
            3  => ['name' => 'Eloquent', 'color' => '#09D7C1'],
            4  => ['name' => 'Envoyer', 'color' => '#F56857'],
            5  => ['name' => 'Forage', 'color' => '#5DB3B7'],
            6  => ['name' => 'General', 'color' => '#4E89DA'],
            7  => ['name' => 'Guides', 'color' => '#D51E22'],
            8  => ['name' => 'JavaScript', 'color' => '#9AD4E0'],
            9  => ['name' => 'Laravel', 'color' => '#F56857'],
            10 => ['name' => 'Lumen', 'color' => '#F9A97A'],
            11 => ['name' => 'Request', 'color' => '#BB824E'],
            12 => ['name' => 'Servers', 'color' => '#F9A97A'],
            13 => ['name' => 'Site FeedBack', 'color' => '#88AD48'],
            14 => ['name' => 'Spark', 'color' => '#66ADD3'],
            15 => ['name' => 'Testing', 'color' => '#DA5757'],
            16 => ['name' => 'Tips', 'color' => '#837EB6'],
            17 => ['name' => 'Vue', 'color' => '#3AB981'],
        ];

        foreach ($channels as $channel) {
            DB::table('channels')->insert([
                'name'       => $channel['name'],
                'color'      => $channel['color'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
