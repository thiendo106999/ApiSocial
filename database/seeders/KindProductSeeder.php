<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KindProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_of_agricultural_products')->insert([
            ['name' => 'luagao', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'hoamau', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'traicay', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
