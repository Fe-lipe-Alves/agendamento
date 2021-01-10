<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'observacao',
    ];

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
}
