<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';
    public $timestamps = false;
    protected $fillable = [
        'especialidade_id',
        'especialista_id'
    ];

    public function especialista()
    {
        return $this->belongsTo(Especialista::class);
    }

    public function especialidade()
    {
        return $this->belongsTo(Especialidade::class);
    }

    public function horarios()
    {
        return $this->hasOne(Horario::class);
    }
}
