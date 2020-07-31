<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::table('permission_role')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Permission::insert([
            // Writer Army
            ['name' => 'Client Access', 'slug' => 'client.access', 'description' => 'Client Access'],
            ['name' => 'Writer Access', 'slug' => 'writer.access', 'description' => 'Writer Access'],
            ['name' => 'Admin Access', 'slug' => 'admin.access', 'description' => 'Admin Access'],
        ]);



        DB::table('permission_role')->insert([
            // Writer Army
            ['role_id' => '1', 'permission_id' => '1'],
            ['role_id' => '1', 'permission_id' => '2'],
            ['role_id' => '1', 'permission_id' => '3'],
            ['role_id' => '2', 'permission_id' => '1'],
            ['role_id' => '3', 'permission_id' => '2'],
        ]);
    }
}
