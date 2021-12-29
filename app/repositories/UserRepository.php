<?php

namespace Framework\Repositories;

use Framework\Models\User;

class UserRepository implements UserRepositoryInterface {

    public function __construct() 
    {
        $this->model = new User();
    }

    /**
     * getAllUser
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->model->getAll();
    }
}
