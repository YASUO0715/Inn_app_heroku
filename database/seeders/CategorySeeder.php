<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('categories')->first()) {
            DB::table('categories')->insert([
                ['name' => '八幡平'],
                ['name' => '安比高原'],
                ['name' => '焼走'],
            ]);
        }
    }
}
