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
            'name' => 'Arquitectura',
            'duration' => 180,
        ]);
        Service::create([
            'name' => 'Construcción y mantenimiento',
            'duration' => 40,
        ]);
        Service::create([
            'name' => 'Administración de condominios y residencias',
            'duration' => 30,
        ]);
        Service::create([
            'name' => 'Desarrollo móvil',
            'duration' => 60,
        ]);
        Service::create([
            'name' => 'Desarrollo web',
            'duration' => 40,
        ]);
    }
}
