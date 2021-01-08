<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaHorario extends Model
{
    use HasFactory;
    protected $table = 'dia_horario';
    public $timestamps = false;
    protected $fillable = [
        'dia_semana_id',
        'horario_id',
        'agenda_id'
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }

    public function horarios()
    {
        return $this->belongsTo(Horario::class, 'horario_id', 'id');
    }

    public function diaSenana()
    {
        return $this->belongsTo(DiaSemana::class, 'dia_semana_id', 'id');
    }
}
