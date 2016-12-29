<?php

use Illuminate\Database\Seeder;

class RolesUsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('role_user')->insert([
                'user_id'    => $i,
                'role_id'    => 2,
                'created_at' => new DateTime('now'),
                'updated_at' => new DateTime('now'),
            ]);
        }
    }
}
