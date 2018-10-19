<?php

namespace MyNamespace\Controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardController
 *
 * @author fabrizio.conti
 */
class DashboardController extends Controller{
    public function getAll() {
        ob_start();
        require "Views/transactions.tpl.php";
        $this->response = ob_get_contents();
        ob_end_clean();
    }
    
    public function create()
    {
        ob_start();
        require "Views/create.tpl.php";
        $this->response = ob_get_contents();
        ob_end_clean();
    }

    public function sendResponse()
    { 
        http_response_code($this->response_code);
        require "Views/dashboard.tpl.php";
    }
}
