<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiasSemanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dias_semana')->insert([
            ['id' => 1, 'descricao' => 'Domingo', 'codigo' => 0],
            ['id' => 2, 'descricao' => 'Segunda-feira', 'codigo' => 1],
            ['id' => 3, 'descricao' => 'Terça-feira', 'codigo' => 2],
            ['id' => 4, 'descricao' => 'Quarta-feira', 'codigo' => 3],
            ['id' => 5, 'descricao' => 'Quinta-feira', 'codigo' => 4],
            ['id' => 6, 'descricao' => 'Sexta-feira', 'codigo' => 5],
            ['id' => 7, 'descricao' => 'Sabado', 'codigo' => 6],
        ]);
    }
}
