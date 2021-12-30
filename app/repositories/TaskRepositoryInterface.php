<?php

namespace Framework\Repositories;

interface TaskRepositoryInterface {

    public function getAllTasks();

    public function create($attributes = []);

    public function updateStatus($data, $id);

    public function edit($id);
    
}
