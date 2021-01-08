<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAgenda extends Model
{
    use HasFactory;

    protected $table = 'status_agenda';
    public $timestamps = false;

    public function agenda()
    {
        return $this->hasMany(Agenda::class, 'status_id', 'id');
    }
}
