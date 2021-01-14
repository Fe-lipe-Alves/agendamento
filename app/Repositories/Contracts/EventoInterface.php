<?php


namespace App\Repositories\Contracts;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

interface EventoInterface extends BaseRepositoryInterface
{

    public function existe(Carbon $data, Model $agenda);


    public function retornaExistente(Carbon $data, Model $agenda);
}
