<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;


/**
 * Class BaseService
 * @package App\Services
 */
abstract class BaseService
{
   

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param array $payload
     * @return mixed
     */
    public function create(array $payload)
    {
        return $this->model->create($payload);
    }

    /**
     * @param array $payload
     * @param Model $model
     * @return bool
     */
    public function update(array $payload, Model $model)
    {
        return $model->update($payload);
    }
}
