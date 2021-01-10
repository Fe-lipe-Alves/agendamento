<?php


namespace App\Repositories;


use App\Models\Agenda;
use App\Repositories\Contracts\AgendaInterface;

class AgendaRepository extends BaseRepository implements AgendaInterface
{
    protected $modelClass = Agenda::class;

    public function salvar()
    {
        // TODO: Implement salvar() method.
    }
}
