<?php

namespace MyNamespace\Controllers;

require_once './define.php';

/**
 * Description of Controller
 *
 * @author fabrizio.conti
 */

class Controller {

    public $param;
    public $payload;
    protected $response_code;
    protected $response;
    protected $is_json;
    
    public function __construct($param = array()) {

        $this->param = $param;

        $this->payload = json_decode(file_get_contents('php://input'), 1);
        
        $this->response = "";
        
        $this->response_code = 200;
    }
    
    public function sendResponse()
    {
        if($this->is_json == 1)
        {
            header("Content-Type: application/json");
        }  
        http_response_code($this->response_code);
        echo $this->response;
        
        exit();
    }
}
