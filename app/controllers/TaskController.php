<?php

namespace Framework\Controllers;

use Framework\Models\User;
use Framework\Repositories\TaskRepository;
use Illuminate\Support\Facades\Response;

class TaskController extends BaseController {

    public function __construct() {

        $this->task = new TaskRepository();

    }

    public function index()
    {
        $tasks = $this->task->getAllTasks();
        return $this->view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'user_id' => $_POST['userId'],
        ];

        $this->task->create($data);

        return $this->response($data, 200);

    }

    public function updateStatus($id)
    {
        $data = [
            'status' => $_POST['status'],
        ];
        
        $this->task->updateStatus($data, $id);

        return $this->response($data, 200);
        
    }

    public function edit($id)
    {
        $task = $this->task->edit($id);
        return $this->response($task, 200);
    }
}
