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
        $this->call(StatusSeeder::class);
        // \App\Models\User::factory(10)->create();
        // \App\Models\Article::factory(10)->create();
        \App\Models\Attachment::factory(10)->create();

    }
}
