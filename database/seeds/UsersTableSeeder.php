<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = [
        [
          'name' => 'Super Admin',
          'email' => 'superadmin@mail.com',
          'email_verified_at' => now(),
          'password' => Hash::make('superadmin'),
          'roles' => 'Super Admin',
        ],
        [
          'name' => 'Admin',
          'email' => 'admin@mail.com',
          'email_verified_at' => now(),
          'password' => Hash::make('admin'),
          'roles' => 'Admin',
        ],
        [
          'name' => 'Petugas',
          'email' => 'petugas@mail.com',
          'email_verified_at' => now(),
          'password' => Hash::make('petugas'),
          'roles' => 'Petugas',
        ],
      ];

      foreach ($users as $key => $value) {
        try {
          $cek = User::where('email', '=', $value['email'])->first();
          if (!$cek || $cek == null) {
            $user = User::firstOrCreate(Arr::except($value, ['roles']));
            $user->assignRole($value['roles']);
          }
        } catch (\Exception $e) {
          echo $e;
        }
      }
    }
}
