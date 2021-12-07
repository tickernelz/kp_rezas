<?php

namespace Database\Seeders;

use App\Models\HariIni;
use Illuminate\Database\Seeder;

class HariIniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HariIni::create([
            'hari' => 'Senin',
        ]);
    }
}
