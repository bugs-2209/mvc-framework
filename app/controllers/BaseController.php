<?php

namespace Framework\Controllers;

class BaseController {

    const VIEW_FOLDER = __DIR__ . '/../views';

    protected function view($viewPath, $data = [])
    {
        foreach ($data as $key => $value) {
            //$$ = Khai báo biến + key
            $$key = $value;
        }

        return require_once (self::VIEW_FOLDER . '/' . str_replace(".",'/',$viewPath) . '.php');
    }

}