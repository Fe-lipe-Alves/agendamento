<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    protected $table = 'especialistas';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'crm'
    ];

    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class, 'agenda');
    }

    public function agenda()
    {
        return $this->hasMany(Agenda::class);
    }

    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'agenda');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
