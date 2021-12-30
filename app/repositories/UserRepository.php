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

    /**
     * create user
     * @param array $attributes
     * @return mixed
     */
    public function createUser($attributes = [])
    {
        return $this->model->save($attributes);
    }

    /**
     * edit user
     * @param $id
     * @return mixed
     */
    public function editUser($id)
    {
        return $this->model->findById($id);
    }

    /**
     * update user
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateUser($attributes, $id)
    {
        return $this->model->update($attributes, $id);
    }

    /**
     * delete user
     * @param $id
     * @return mixed
     */
    public function deleteUser($id)
    {
        return $this->model->destroy($id);
    }
}
