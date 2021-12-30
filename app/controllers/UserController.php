<?php

namespace Framework\Controllers;

use Framework\Models\User;
use Framework\Repositories\UserRepository;

class UserController extends BaseController {

    public function __construct() {

        $this->user =  new UserRepository();
    }
    public function index()
    {
        $users = $this->user->getAllUsers();

        return $this->view('users.index', ['users' => $users]);
    }
    
    public function create()
    {   
        $errors = [];
        if (empty($_POST['name'])) {
           $errors['name'] = 'Vui lòng nhập tên';
        }

        if (empty($_POST['email'])) {
            $errors['email'] = 'Vui lòng nhập email';
        }

        if (empty($_POST['password'])) {
            $errors['password'] = 'Vui lòng nhập password';
        }

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => md5($_POST['name']),
        ];
        
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $this->user->createUser($data);
        }

        return $this->response($data, 200);
    }

    public function edit($id)
    {
        $user = $this->user->editUser($id);

        return $this->response($user, 200);
    }

    public function update($id) {

        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
        ];

        $this->user->updateUser($data, $id);

        return $this->response($data, 200);

    }

    public function delete($id)
    {
        $this->user->deleteUser($id);
    }
}
