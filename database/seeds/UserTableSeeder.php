<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_user  = User::create([
            'name' => 'Administrador',
            'identification'=> '0123456789',
            'email'=> 'admin@turiapp.com',
            'password' => bcrypt('turiapp$2022.'),
        ]);

        $admin_user->assignRole('Administrador');
    }
}
