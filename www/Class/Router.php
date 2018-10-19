<?php

namespace MyNamespace;

use MyNamespace\Controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author fabrizio.conti
 */
class Router {
    
    private $routes;
    
    private $db_conn;
    
    private $request = array();
    
    public function __construct($conn) {
        $this->db_conn = $conn;
    }
    
    public function loadRoutes($routes_ay)
    {
        $this->routes = $routes_ay;
    }

    public function validateRoute()
    {
        if(isset($this->routes['routes'][$_SERVER['REQUEST_METHOD']]))
        {
            foreach ($this->routes['routes'][$_SERVER['REQUEST_METHOD']] as $route => $value) {
                
                $uri = $_SERVER['REQUEST_URI'];
                
                if(str_replace("/", "", $uri) == $route)
                {
                    $this->request['action'] = $value;
                    $this->request['params'] = "";
                    return true;
                }
                else
                {   
                    $uri.="/";
                    list($controller, $elem) = explode("/", substr($uri, 1));
                    list($route_controller) = explode("/", $route);
                    
                    if($controller == $route_controller && is_numeric($elem))
                    {
                        $this->request['action'] = $value;
                        $this->request['params'] = $elem;

                        return true;
                    } 
                }
            }   
            return false;
        }    
        return false;
    }
    
    public function dispatch()
    {   
        if(!empty($this->request))
        {
            $controller = "";
            
            $method = "";
            
            $param = [];
            
            list($controller, $method) = explode("@", $this->request['action']);
            
            $param = $this->request['params'];
            
            if(class_exists($controller))
            {       
                $cnt = new $controller($param, $this->db_conn);
                
                if(method_exists($cnt, $method))
                {
                    $cnt->$method();

                    $cnt->sendResponse();
                }               
            }
        }
    }
}
