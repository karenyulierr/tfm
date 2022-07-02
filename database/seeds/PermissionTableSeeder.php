<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = Role::updateOrCreate(['name' => 'Administrador' ]);
        $Site = Role::updateOrCreate(['name' => 'Cliente/Sitio turístico' ]);
        Permission::updateOrCreate([
            'name' => 'Gestión roles'
        ]);
        Permission::updateOrCreate([
            'name' => 'Gestión usuarios'
        ]);
        Permission::updateOrCreate([
            'name' => 'Ver administración'
        ]);
        Permission::updateOrCreate([
            'name' => 'Ver categorias'
        ]);
        Permission::updateOrCreate([
            'name' => 'Crear categorias'
        ]);
        Permission::updateOrCreate([
            'name' => 'Ver servicios'
        ]);
        Permission::updateOrCreate([
            'name' => 'Crear servicios'
        ]);
        Permission::updateOrCreate([
            'name' => 'Ver sitios turísticos'
        ]);
        Permission::updateOrCreate([
            'name' => 'Crear sitios turísticos'
        ]);
        Permission::updateOrCreate([
            'name' => 'Editar sitios turísticos'
        ]);
        Permission::updateOrCreate([
            'name' => 'Crear reglas'
        ]);
        Permission::updateOrCreate([
            'name' => 'Ver planes turísticos'
        ]);
        Permission::updateOrCreate([
            'name' => 'Crear planes turísticos'
        ]);
        Permission::updateOrCreate([
            'name' => 'Ver reseñas'
        ]);
        $Admin->givePermissionTo(Permission::all());
    }
}
