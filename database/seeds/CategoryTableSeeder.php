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
            'name' => 'Restaurante',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Finca',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Hotel',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Postrería',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Termalismo',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Casa de campo',
            'state' => 'active',
            'user_id' => 1,
        ]);
        Category::create([
            'name' => 'Mirador',
            'state' => 'active',
            'user_id' => 1,
        ]);
    }
}
