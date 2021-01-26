<?php


namespace App\Repositories\Contracts;


interface DiaSemanaInterface extends BaseRepositoryInterface
{
    /**
     * Retorna o objeto do dia da semana correspondente a data informada
     *
     * @param $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     * @throws \Exception
     */
    public function resolverDia($data);
}
