<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';
    protected $fillable = [
        'status_evento_id',
        'agenda_id',
        'titulo',
        'descricao',
        'data',
        'inicio',
        'termino',
        'habilitado'
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusEvento::class);
    }
}
