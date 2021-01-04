<?php


namespace App\Repositories\Contracts;


use Exception;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Obtem ou altera o objeto modelo do repositório
     *
     * @param Model|null $model
     * @return $this|Model
     * @throws Exception
     */
    public function model(Model $model = null);
}
