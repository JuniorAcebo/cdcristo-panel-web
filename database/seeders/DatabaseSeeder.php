<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'JuniorSesario',
            'email' => 'juniorsesario@gmail.com',
            'password' => bcrypt('Junior123'),
            'is_admin' => true // Campo que indica si es administrador
        ]);

        $this->call(ServicioSeeder::class);
    }
}
