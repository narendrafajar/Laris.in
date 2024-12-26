<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seed = [
            ['company_name' => 'Yuukinoko', 'company_code' => 'YNK','created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'DiliciousNuts', 'company_code' => 'DLC', 'created_at' => now(), 'updated_at' => now()]
        ];

        DB::table('master_type_company')->insert($seed);
    }
}
