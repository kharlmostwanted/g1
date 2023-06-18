<?php

namespace Database\Seeders;

use App\Imports\PaymentsImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new PaymentsImport, database_path('seeders/files/g1-data.xlsx'));
    }
}
