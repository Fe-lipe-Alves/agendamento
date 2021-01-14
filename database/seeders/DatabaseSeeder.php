<?php

namespace Database\Seeders;

use App\Models\Especialista;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DiasSemanaSeeder::class);

        Especialista::factory()->for(User::factory())->create();
    }
}
