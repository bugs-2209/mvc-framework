<?php

namespace Framework\Controllers;

class HomeController extends BaseController {

    public function index()
    {
        return $this->view('home.index');
    }
}
