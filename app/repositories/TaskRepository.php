<?php

namespace Framework\Repositories;

use Framework\Models\Task;

class TaskRepository implements TaskRepositoryInterface {

    public function __construct()
    {
        $this->model = new Task();
    }

    public function getAllTasks()
    {
        return $this->model->getAll();
    }

    public function create($attributes = [])
    {
        return $this->model->save($attributes);
    }

    public function updateStatus($attributes, $id)
    {   
        return $this->model->update($attributes, $id);
    }

    public function edit($id)
    {
        return $this->model->findById($id);
    }
}
