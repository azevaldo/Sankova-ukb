<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::create(['name' => 'gerir curso']);
        Permission::create(['name' => 'gerir faculdade']);
        Permission::create(['name' => 'gerir universidade']);
        Permission::create(['name' => 'gerir tudo']);
        Permission::create(['name' => 'gerir normal']);
         
        


         // Criar papéis e atribuir permissões
         $admin = Role::create(['name' => 'admin']);
         $admin->givePermissionTo(['gerir tudo', 'gerir curso', 'gerir faculdade','gerir universidade','gerir normal']);
 
         $admin_universidade = Role::create(['name' => 'admin_universidade']);
         $admin_universidade->givePermissionTo(['gerir universidade','gerir curso','gerir faculdade','gerir normal']);

         $admin_faculdade = Role::create(['name' => 'admin_faculdade']);
         $admin_faculdade->givePermissionTo(['gerir curso','gerir faculdade','gerir normal']);

         $admin_curso = Role::create(['name' => 'admin_curso']);
         $admin_curso->givePermissionTo(['gerir curso','gerir normal']);


         $user_normal = Role::create(['name' => 'normal']);
         $user_normal->givePermissionTo(['gerir normal']);
    }
}
