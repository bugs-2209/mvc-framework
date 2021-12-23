<?php

namespace Framework\Controllers;

use Framework\Models\User;

class UserController extends BaseController {

    public function __construct() {
        $this->user = new User();
    }
    public function index()
    {
        $users = $this->user->getAll();

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
