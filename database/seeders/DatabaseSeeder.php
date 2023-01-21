<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Creación de roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'personal']);
        Role::create(['name' => 'cliente']);

        //Creación de usuarios
        // $userAdmin = \App\Models\User::factory()->create([
        //     'name' => 'Cesar',
        //     'email' => 'cesar@gmail.com'
        // ]);
        $contraseña = "12345";
        $userAdmin = new User([
            "email" => "cesar@gmail.com",
            "password" => Hash::make($contraseña),
            "name" => "Cesar",
        ]);
        $userAdmin->saveOrFail();
        // $userPersonal = \App\Models\User::factory()->create([
        //     'name' => 'Jose',
        //     'email' => 'jose@gmail.com'
        // ]);
        // $userPersonal2 = \App\Models\User::factory()->create([
        //     'name' => 'Juan',
        //     'email' => 'Juan@gmail.com'
        // ]);
        // $users = \App\Models\User::factory(5)->create();

        //Asignación de roles a cada usuario
        $userAdmin->assignRole('admin');
        // $userPersonal->assignRole('personal');
        // $userPersonal2->assignRole('personal');

        // foreach ($users as $user) {
        //     $user->assignRole('cliente');
        // }

        $this->call(OpeningHoursSeeder::class);
        $this->call(ServicesSeeder::class);
    }
}
