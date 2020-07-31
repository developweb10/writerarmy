<?php
namespace Modules\Acl\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\Role;

class RolesTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    Role::unguard();

    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    Role::truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    Role::insert([
      ['name' => 'Super User', 'slug' => 'superuser', 'description' => 'Super Administrative access'],
      ['name' => 'Administrator', 'slug' => 'administrator', 'description' => 'Administrative access'],
      ['name' => 'Editor', 'slug' => 'editor', 'description' => 'Sub Administrative access'],
      ['name' => 'Reporter', 'slug' => 'reporter', 'description' => 'Reporting access'],
      ['name' => 'Guest', 'slug' => 'guest', 'description' => 'Guest access'],
    ]);
  }

}