<?php


namespace App\Repositories;


use App\Models\DiaSemana;
use App\Repositories\Contracts\DiaSemanaInterface;
use Carbon\Carbon;

class DiaSemanaRepository extends BaseRepository implements DiaSemanaInterface
{
    protected $modelClass = DiaSemana::class;


    public function resolverDia($data)
    {
        if ($data instanceof Carbon){
            $dia = $data->dayOfWeek;
        } else if (is_string($data)) {
            $dia = (new Carbon($data))->dayOfWeek;
        } else if(is_integer($data) && $data >= 0 && $data <= 6){
            $dia = $data;
        } else {
            return null;
        }

        return DiaSemana::query()->where('codigo', '=', $dia)->first();
    }
}
