<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(PackageTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
    }
}
