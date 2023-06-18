<?php

namespace Database\Seeders;

use App\Imports\HouseholdsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class HouseholdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new HouseholdsImport, database_path('seeders/files/g1-data.xlsx'));
    }
}
