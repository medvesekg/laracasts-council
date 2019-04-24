<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Thread::class, 20)->create();

        factory(\App\User::class)->create([
           "name" => "Gregor Medvesek",
           "email" => "gregor.medvesek@dewesoft.com",
           "password" => \Illuminate\Support\Facades\Hash::make("dewesoft"),
            "confirmed" => true
        ]);
    }
}
