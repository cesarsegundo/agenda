<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;


class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Tinturado de cabello',
            'duration' => 180,
        ]);
        Service::create([
            'name' => 'Corte de cabello',
            'duration' => 40,
        ]);
        Service::create([
            'name' => 'Maquillaje básico',
            'duration' => 30,
        ]);
        Service::create([
            'name' => 'Maquillaje avansado',
            'duration' => 60,
        ]);
        Service::create([
            'name' => 'Pintado de uñas básico',
            'duration' => 40,
        ]);
    }
}
