<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;

    protected $table = 'especialidades';
    public $timestamps = false;
    protected $fillable = [
        'descricao'
    ];

    public function especialistas()
    {
        return $this->belongsToMany(Especialista::class, 'agenda');
    }

    public function agenda()
    {
        return $this->hasMany(Agenda::class);
    }

    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'agenda');
    }
}
