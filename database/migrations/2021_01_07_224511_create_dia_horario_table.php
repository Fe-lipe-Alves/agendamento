<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_horario', function (Blueprint $table) {
            $table->foreignId('dia_semana_id')->constrained('dias_semana');
            $table->foreignId('horario_id')->constrained('horarios');
            $table->foreignId('agenda_id')->constrained('agenda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dia_horario');
    }
}
