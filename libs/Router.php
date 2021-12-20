<?php

namespace Framework;

class Router
{
    /**
     * @param $pattern
     * @param string $dest
     * Note: 
     * 
     */
    private static $routeTable = [];
    // Xác định route hiện tại
    public $currentRoute = null;

    public static function get($path, $ctlAction)
    {
        $method = RouterMethod::GET;
        $pattern = $path;
        $dest = explode("@", $ctlAction);
        self::setRouteTable($method, $pattern, $dest);
    }

    public static function setRouteTable($method, $pattern, $dest = [])
    { 
        self::$routeTable[$method][$pattern] = [
            'controller' => $dest[0],
            'action' => $dest[1] ?? 'index',
        ];
    }

    //Match current URL router table and set current route
    private function matching() 
    {
        //parse_url: split url & querystring to array
        $url = parse_url($_SERVER['REQUEST_URI']);
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $url['path'];
        $routeTables = self::$routeTable[$method];
        $patternScore = [];
        
        //Check $path === $this->routeTable
        foreach ($routeTables as $pattern => $value) {
            if ($pattern === $path) {
                $this->currentRoute = $routeTables[$pattern];
                break;
            }
            $patternScore[] = $this->patternScore($path, $pattern);
        }
        if ($this->currentRoute != NULL) {
            usort($patternScore, function($a, $b) {
                if ($a['score'] === $b['score']) {
                    return count($a['param']) < count($b['param']);
                }
                return $a['score'] < $b['score'];
            });

            $this->currentRoute = self::$routeTable[$method][$patternScore[0]['pattern']];
            $this->currentRoute['param'] = $patternScore[0]['param'];
        }
        
        echo "<pre>";
        var_dump($this->currentRoute);
        die;
        //Output: currentRoute = ['controller' => '', 'action' => '', 'params' => ['id' => '...']];
    }

    private function patternScore($path, $pattern)
    {   
        $path = explode('/', $path);
        
        $exPattern = explode('/', $pattern);

        if (count($path) != count($exPattern)) {
            return ['score' => 0, 'param' => '', 'pattern' => $pattern];
        }
        
        $score = 0;
        $param = [];

        foreach ($exPattern as $key => $value) {
            if ($path[$key] == $value) {
                $score += 1;                                         
            } else {
                $convertP = $this->convertParam($value);
                if ($convertP) {
                    $param[$convertP] = $path[$key];
                }
            }
        }
        
        return ['score' => $score, 'param' => $param, 'pattern' => $pattern];
    }

    private function convertParam($value)
    {
        $start = substr($value, 0, 1);
        $end = substr($value, -1, 1);
        
        if ($start == "{" && $end == "}") {
            return str_replace(['{', '}'], '', $value);
        }
        return '';
    }

    public function getRoute()
    {   
        $this->matching();
        return $this->currentRoute;
    }


}
