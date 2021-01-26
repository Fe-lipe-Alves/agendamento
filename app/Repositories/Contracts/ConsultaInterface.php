<?php


namespace App\Repositories\Contracts;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

interface ConsultaInterface extends BaseRepositoryInterface
{
    /**
     * Obtem todas as consultas agendadas para uma determinada data
     *
     * @param Carbon $data
     * @param Model $agenda
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function todasData(Carbon $data, Model $agenda);
}
