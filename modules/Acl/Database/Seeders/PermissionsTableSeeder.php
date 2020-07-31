<?php
namespace Modules\Acl\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Acl\Entities\Permission;

class PermissionsTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Permission::unguard();

    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    Permission::truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    Permission::insert([
      // User Module
      ['name' => 'Create new User', 'slug' => 'user.create', 'description' => 'User Create', 'model' => 'User'],
      ['name' => 'Edit User', 'slug' => 'user.edit', 'description' => 'User Edit/Update', 'model' => 'User'],
      ['name' => 'Delete User', 'slug' => 'user.delete', 'description' => 'User Delete', 'model' => 'User'],
      ['name' => 'User Overview', 'slug' => 'user.overview', 'description' => 'Overview of user', 'model' => 'User'],
      ['name' => 'User Report', 'slug' => 'user.report', 'description' => 'Generate report of user', 'model' => 'User'],

      // Employee Module
      ['name' => 'Create new Employee', 'slug' => 'employee.create', 'description' => 'Employee Create', 'model' => 'Employee'],
      ['name' => 'Edit Employee', 'slug' => 'employee.edit', 'description' => 'Employee Edit/Update', 'model' => 'Employee'],
      ['name' => 'Delete Employee', 'slug' => 'employee.delete', 'description' => 'Employee Delete', 'model' => 'Employee'],
      ['name' => 'Employee Overview', 'slug' => 'employee.overview', 'description' => 'Overview of employee', 'model' => 'Employee'],
      ['name' => 'Employee Report', 'slug' => 'employee.report', 'description' => 'Generate report of employee', 'model' => 'Employee'],

      // Asset Module
      ['name' => 'Create new Asset', 'slug' => 'asset.create', 'description' => 'Asset Create', 'model' => 'Asset'],
      ['name' => 'Edit Asset', 'slug' => 'asset.edit', 'description' => 'Asset Edit/Update', 'model' => 'Asset'],
      ['name' => 'Delete Asset', 'slug' => 'asset.delete', 'description' => 'Asset Delete', 'model' => 'Asset'],
      ['name' => 'Asset Overview', 'slug' => 'asset.overview', 'description' => 'Overview of asset', 'model' => 'Asset'],
      ['name' => 'Asset Report', 'slug' => 'asset.report', 'description' => 'Generate report of asset', 'model' => 'Asset'],

      // Blog Module
      ['name' => 'Create new Blog', 'slug' => 'blog.create', 'description' => 'Blog Create', 'model' => 'Blog'],
      ['name' => 'Edit Blog', 'slug' => 'blog.edit', 'description' => 'Blog Edit/Update', 'model' => 'Blog'],
      ['name' => 'Delete Blog', 'slug' => 'blog.delete', 'description' => 'Blog Delete', 'model' => 'Blog'],
      ['name' => 'Blog Overview', 'slug' => 'blog.overview', 'description' => 'Overview of blog', 'model' => 'Blog'],
      ['name' => 'Blog Report', 'slug' => 'blog.report', 'description' => 'Generate report of blog', 'model' => 'Blog'],

      // Patient Module
      ['name' => 'Create new Patient', 'slug' => 'patient.create', 'description' => 'Patient Create', 'model' => 'Patient'],
      ['name' => 'Edit Patient', 'slug' => 'patient.edit', 'description' => 'Patient Edit/Update', 'model' => 'Patient'],
      ['name' => 'Delete Patient', 'slug' => 'patient.delete', 'description' => 'Patient Delete', 'model' => 'Patient'],
      ['name' => 'Patient Overview', 'slug' => 'patient.overview', 'description' => 'Overview of patient', 'model' => 'Patient'],
      ['name' => 'Patient Report', 'slug' => 'patient.report', 'description' => 'Generate report of patient', 'model' => 'Patient'],

    ]);
  }

}