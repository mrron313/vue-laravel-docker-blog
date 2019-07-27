<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array(
              'name' => 'admin',
              'user_name' => 'admin',
              'email' => 'admin@techblog.com',
              'email_verified_at' => now(),
              'role' => 1,
              'password' => '$2y$10$/jovDsXVDLPktHAwnlmQzurKo.3Gx3DNhy7oIzXfdJqffCQoyT7xi', // password
              'identification_token' => Str::random(32),
              'remember_token' => Str::random(10),
            ),
          ));

        factory(App\Models\User::class, 50)->create();
    }
}
