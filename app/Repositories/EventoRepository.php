<?php


namespace App\Repositories;


use App\Models\Evento;
use App\Repositories\Contracts\EventoInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EventoRepository extends BaseRepository implements EventoInterface
{
    protected $modelClass = Evento::class;

    public function existe(Carbon $data, Model $agenda)
    {
        return $this->retornaExistente($data, $agenda) != false;
    }

    public function retornaExistente(Carbon $data, Model $agenda, \Closure $closure = null)
    {
        $consulta = Evento::query()->whereDate('data', '=', $data)
            ->where('agenda_id', '=', $agenda->id);
        if($closure != null){
            $closure($consulta);
        }

        DB::enableQueryLog();
        $resposta = $consulta->get();

        if ($resposta !=  null)
            return $resposta;
        else
            return false;
    }
}
