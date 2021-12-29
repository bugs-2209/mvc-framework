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
        return $this->view('users.create');
    }

    public function edit($id)
    {
        $i = $id;
        return $this->view('users.edit');
    }
}
