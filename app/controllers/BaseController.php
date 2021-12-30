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

    protected function response($data, $status = '')
    {
        //header_remove() : Clear all header previously
        header_remove();

        header("Content-type: application/json; charset=utf-8");

        if ($status) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
        
        echo json_encode($data);
    }
}
