<?php

namespace App\Http\Services;

use App\Models\Admin;

class AdminService
{
    private $model;
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function getAll($conditions = [], $with = [], $per_page = 0)
    {
        $items = count($with) ? $this->model->with($with) : $this->model;
        $items = $per_page ? $items->where($conditions)->paginate($per_page) : $items->where($conditions)->get();

        return $items;
    }

    public function find($conditions = [], $with = [])
    {
        $item = count($with) ? $this->model->with($with) : $this->model;
        $item = $item->where($conditions)->first();

        return $item;
    }

    public function getById($conditions)
    {
        $item = $this->model->where($conditions)->first();
        return $item;
    }

    public function create(array $data)
    {
        $item = $this->model->create($data);
        return $item;
    }

    public function update($condition, array $data)
    {
        $item = $this->model->where($condition)->update($data);
        return $item;
    }

    public function destroy($condition)
    {
        $item = $this->model->where($condition)->delete();
        return $item;
    }


}
