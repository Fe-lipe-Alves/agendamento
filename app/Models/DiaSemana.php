<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaSemana extends Model
{
    use HasFactory;

    protected $table = 'dias_semana';
    public $timestamps = false;
    protected $fillable = [
        'descricao'
    ];

    public function horarios()
    {
        return $this->hasManyThrough(
            Horario::class,
            DiaHorario::class,
            'dia_semana_id',
            'id',
            'id',
            'horario_id'
        );
    }

    public function agenda()
    {
        return $this->hasOneThrough(
            Agenda::class,
            DiaHorario::class,
            'dia_semana_id',
            'id',
            'id',
            'agenda_id',
        );
    }
}
