<?php

namespace App\Services;

class CrudService
{
    protected $modelClass;

    public function find()
    {
        return $this->modelClass::query();
    }

    public function add(array $data)
    {
        throw new \Exception('Not implemented yet');
    }

    public function update($id, array $data)
    {
        throw new \Exception('Not implemented yet');
    }
}
