<?php


namespace App\Repositories;


use App\Models\Evento;
use App\Repositories\Contracts\EventoInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EventoRepository extends BaseRepository implements EventoInterface
{
    protected $modelClass = Evento::class;

    public function existe(Carbon $data, Model $agenda)
    {
        return $this->retornaExistente($data, $agenda) != false;
    }

    public function retornaExistente(Carbon $data, Model $agenda)
    {
        $resposta = Evento::query()->whereDate('data', '=', $data)
            ->where('agenda_id', '=', $agenda->id)->first();
        if ($resposta !=  null)
            return $resposta;
        else
            return false;
    }
}
