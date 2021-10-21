<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('statuses')->first()) {
            DB::table('statuses')->insert([
                ['name' => '◎'],
                ['name' => '☓'],
            ]);
        }
    }
}
