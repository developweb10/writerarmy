<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Role::insert([
              ['name' => 'Admin', 'slug' => 'admin'],
              ['name' => 'Client', 'slug' => 'client'],
              ['name' => 'Writer', 'slug' => 'writer'],
        ]);
    }
}
