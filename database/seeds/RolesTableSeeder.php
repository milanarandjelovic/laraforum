<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'user'];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name'       => $role,
                'created_at' => new DateTime('now'),
                'updated_at' => new DateTime('now'),
            ]);
        }
    }
}
