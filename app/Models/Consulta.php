<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';
    protected $fillable = [
        'paciente_id',
        'agenda_id',
        'criador_id',
        'status_consulta_id',
        'retorno',
        'duracao',
        'observacao'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function criador()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusConsulta::class, 'status_consulta_id', 'id');
    }
}
