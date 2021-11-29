<?php

namespace Database\Seeders;

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

        \App\Models\Post::factory(20)->create();

        \App\Models\Store::factory(20)->create();

        \App\Models\Item::factory(20)->create();

        \App\Models\Comment::factory(20)->create();

        $this->call([
            UsersSeeder::class
            ]);
    }
}
