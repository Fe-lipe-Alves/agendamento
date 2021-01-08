<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_agenda_id')->constrained('status_agenda');
//            $table->foreignId('especialista_id')->constrained('especialista');
//            $table->foreignId('especialidade_id')->constrained('especialidade');
            $table->date('data');
            $table->boolean('hablitado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda');
    }
}
