<?php

namespace MyNamespace\Controllers;

use MyNamespace\Models;

use MyNamespace\Connect;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author fabrizio.conti
 */
class ProductController extends Controller{
    
    public $content;
    
    public $product;
    
    private $validationResult;
    
    private $fieldList;
    
    public function __construct($param = array(), $db_conn)
    {  
        parent::__construct($param);
         
        $this->product = new Models\Product($db_conn);
        
        $this->validationResult = 1;
        
        $this->fieldList = array();
        
        $this->is_json = 1;
    }
    
    private function validateRequest($value, $key)
    {
        if(!in_array(strtolower($key), $this->fieldList))
        {
            $this->validationResult = 0;
        }    
    }
    
    public function getAll()
    {
        try {
            $products = $this->product->getAllProducts();

            $this->response = json_encode($products);

        } catch (\PDOException $exc) {  
            $this->response = json_encode(["status" => 0, "message" => $exc->getMessage()]);
            
            $this->response_code = 500;
        }   
    }
}
