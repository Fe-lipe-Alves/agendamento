<?php


namespace App\Repositories;


use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements Contracts\BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass;


    public function __construct(Model $model = null)
    {
        $this->model = $model;
        if ($this->model == null && $this->modelClass != null)
            $this->model = new $this->modelClass();
    }

    public function model(Model $model = null)
    {
        if ($model != null){
            if($model instanceof $this->modelClass){
                $this->model = $model;
                return $this;
            } else {
                throw new Exception("Modelo recebido não compatível com o esperado");
            }
        } else {
            return $this->model;
        }
    }
}
