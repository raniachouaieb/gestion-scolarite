<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Rania',
            'email' => 'raniachouaieb82@gmail.com',
            'password' => Hash::make('raniadmin1'),
        ]);
    }
}
