<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Talle;

class TalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $talles = ['S', 'M', 'L', 'XL'];
        
        foreach ($talles as $talle) {
            Talle::firstOrCreate(['nombre' => $talle]);
        }
    }
}
