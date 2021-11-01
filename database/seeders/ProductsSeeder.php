<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'Mít Thái', 'user_id' => 3, 'phone_number' => '0348209030', 'address' => 'Vĩnh Long', 'image' => 'null', 'date' => '16-10-2021', 'hexta' => 1, 'kind_id' => 3, 'status' => 'registered', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mít Tố nữ', 'user_id' => 3, 'phone_number' => '0348209030', 'address' => 'Vĩnh Long', 'image' => 'null', 'date' => '20-10-2021', 'hexta' => 1, 'kind_id' => 3, 'status' => 'registered', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mít Ruột đỏ', 'user_id' => 3, 'phone_number' => '0348209030', 'address' => 'Vĩnh Long', 'image' => 'null', 'date' => '16-10-2021', 'hexta' => 1, 'kind_id' => 3, 'status' => 'approved', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Lúa OM', 'user_id' => 1, 'phone_number' => '0348209030', 'address' => 'Long An', 'image' => 'null', 'date' => '16-10-2021', 'hexta' => 10, 'kind_id' => 1, 'status' => 'registered', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Nếp', 'user_id' => 1, 'phone_number' => '0348209030', 'address' => 'Long An', 'image' => 'null', 'date' => '16-10-2021', 'hexta' => 10, 'kind_id' => 1, 'status' => 'approved', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
