<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class GroupTableSeeder extends Seeder
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
        Group::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Group::insert([
              ['group_name' => 'Admin'],
              ['group_name' => 'Client'],
              ['group_name' => 'Writer'],
        ]);
    }
}
