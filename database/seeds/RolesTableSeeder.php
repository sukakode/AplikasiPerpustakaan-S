<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roles = [
        [
          'name' => 'Super Admin',
        ],
        [
          'name' => 'Admin',
        ],
        [
          'name' => 'Petugas',
        ]
      ];

      foreach ($roles as $key => $value) {
        try {
          $role = Role::firstOrCreate($value);
        } catch (\Exception $th) {
          //throw $th;
        }
      }
    }
}
