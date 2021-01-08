<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusEvento extends Model
{
    use HasFactory;

    protected $table = 'status_evento';
    public $timestamps = false;

    public function agenda()
    {
        return $this->hasMany(Evento::class, 'status_evento_id', 'id');
    }
}
