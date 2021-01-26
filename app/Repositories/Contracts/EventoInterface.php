<?php


namespace App\Repositories\Contracts;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

interface EventoInterface extends BaseRepositoryInterface
{
    /**
     * Retorna um booleano se existir algum evento na data e agenda informada
     *
     * @param Carbon $data
     * @param Model $agenda
     * @return mixed
     */
    public function existe(Carbon $data, Model $agenda);

    /**
     * Retorna eventos existentes para a data e agenda informada
     *
     * @param Carbon $data
     * @param Model $agenda
     * @param \Closure $closure
     * @return mixed
     */
    public function retornaExistente(Carbon $data, Model $agenda, \Closure $closure = null);
}
