<?php

namespace Framework\Controllers;

use Framework\Models\User;
use Framework\Repositories\TaskRepository;
use Framework\Repositories\UserRepository;
use Illuminate\Support\Facades\Response;

class TaskController extends BaseController {

    public function __construct() {

        $this->task = new TaskRepository();
        $this->user = new UserRepository();

    }

    public function index()
    {
        $tasks = $this->task->getAllTasks();
        $users = $this->user->getAllUsers();

        return $this->view('tasks.index', ['tasks' => $tasks, 'users' => $users]);
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
        $users = $this->user->getAllUsers();
        
        return $this->response([$task, $users], 200);
    }

    public function update($id)
    {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'user_id' => $_POST['userId'],
        ];

        $this->task->updateTask($data, $id);
        
        return $this->response($data, 200);
    }
}
