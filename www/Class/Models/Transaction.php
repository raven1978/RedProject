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
 * Description of Transaction
 *
 * @author fabrizio.conti
 */
class Transaction {
    public $db_conn;
    
    public function __construct($db_conn) {
        $this->db_conn = $db_conn;
    }
    
    public function getAllTransactions() 
    {
        $result = $this->db_conn->query("Select * From transaction");
        
        return $result;
    }
    
    public function getTransaction($params = array()) 
    {
        $query = "SELECT * FROM transaction";
        
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
    
    public function deleteTransaction($params = array())
    {
        $query = "DELETE FROM transaction";
        
        if(!empty($params))
        {
            $query .= " WHERE ";
            
            foreach ($params as $key => $value) {   
                $query .= "$key = :$key AND ";
            }
            
            $query .= "1";
        }

        $this->db_conn->queryBind($query, $params);
        
        return true;
    }

    public function getTransactionFields()
    {
        return $this->db_conn->getTableFields('transaction');
    }
    
    public function createTransaction($params)
    {

        $result = $this->db_conn->queryBind("INSERT INTO transaction (user_id, product_id, amount, currency) VALUES (:user_id, :product_id, :amount, :currency)", $params);
    }
    
}
