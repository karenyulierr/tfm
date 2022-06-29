<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Restaurantes',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Fincas',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Hoteles',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Postrerías',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Termalismos',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Casas de campo',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Miradores',
            'state' => 'active',
            'user_id' => 1,
        ]);
    }
}
