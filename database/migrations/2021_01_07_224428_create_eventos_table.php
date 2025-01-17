<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_evento_id')->constrained('status_evento');
            $table->foreignId('agenda_id')->constrained('agenda');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->date('data');
            $table->dateTime('inicio');
            $table->dateTime('termino');
            $table->boolean('habilitado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
