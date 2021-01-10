<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusConsulta extends Model
{
    use HasFactory;

    protected $table = 'status_consultas';
    public $timestamps = false;
    protected $fillable = [
        'descricao',
        'habilitado'
    ];

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
}
