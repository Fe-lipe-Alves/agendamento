<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    public $timestamps = false;
    protected $fillable = [
        'dia_semana_id',
        'abertura',
        'inicio_intervalo',
        'termino_intervalo',
        'encerramento'
    ];

    public function agenda()
    {
        return $this->hasOneThrough(
            Agenda::class,
            DiaHorario::class,
            'horario_id',
            'id',
            'id',
            'agenda_id',
        );
    }

    public function dias()
    {
        return $this->hasOneThrough(
            DiaSemana::class,
            DiaHorario::class,
            'horario_id',
            'id',
            'id',
            'dia_semana_id',
        );
    }
}
