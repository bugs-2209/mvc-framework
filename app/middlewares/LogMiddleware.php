<?php

namespace Framework\Middlewares;

class LogMiddleware {

    public $next = true;

    public function action($router, $method, $params)
    {
        // if ($params['id'] == 3) {
        //     return $this->next = false;
        // }
        return $this->next;
    }

}
