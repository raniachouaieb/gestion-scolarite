<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('admins')->insert([
            'name' => 'Rania',
            'email' => 'raniachouaieb82@gmail.com',
            'password' => Hash::make('adminrania1'),
            'roles_name'=>"Admin",
        ]);


    }
}
