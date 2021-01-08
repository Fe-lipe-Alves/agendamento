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
        return $this->hasMany(Horario::class);
    }
}
