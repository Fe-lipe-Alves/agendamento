<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';
    public $timestamps = false;

    public function status()
    {
        return $this->belongsTo(StatusAgenda::class, 'status_id', 'id');
    }
}
