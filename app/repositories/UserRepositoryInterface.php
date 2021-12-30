<?php

namespace Framework\Repositories;

interface UserRepositoryInterface {

    public function getAllUsers();

    public function createUser($attributes = []);

    public function editUser($id);

    public function updateUser($attributes, $id);

    public function deleteUser($id);

}
