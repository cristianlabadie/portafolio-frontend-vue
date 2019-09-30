<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // $this->call(UsersTableSeeder::class);

      User::create([
        'name' => 'Admin',
        'email' => 'admin@test.com',
        'password' => Hash::make('admin'),
        'role' => 2
        'admin' => 1
      ]);

      User::create([
        'name' => 'Cristian',
        'email' => 'cristian@test.com',
        'password' => Hash::make('cristian'),
        'role' => 1
        'admin' => 0
      ]);
    }
}
