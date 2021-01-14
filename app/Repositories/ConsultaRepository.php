<?php


namespace App\Repositories;


use App\Models\Consulta;
use App\Repositories\Contracts\ConsultaInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ConsultaRepository extends BaseRepository implements ConsultaInterface
{
    protected $modelClass = Consulta::class;

    public function todasData(Carbon $data, Model $agenda)
    {
        return Consulta::query()->whereDate('data', '=', $data)
            ->where('agenda_id', $agenda->id)->get();
    }
}
