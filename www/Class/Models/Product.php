<?php
namespace MyNamespace\Models;

require_once './define.php';

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
class Product {
    public $db_conn;
    
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }
    
    public function getAllProducts() 
    {
        $result = $this->db_conn->query("Select * From products");
        
        return $result;
    }
    
    public function getProduct($params = array())
    {
        $query = "SELECT * FROM products";
        
        if(!empty($params))
        {
            $query .= " WHERE ";
            
            foreach ($params as $key => $value) {   
                $query .= "$key = :$key AND ";
            }
            
            $query .= "1";
        }

        $result = $this->db_conn->queryBind($query, $params);
        
        return $result;
    }
    
}
