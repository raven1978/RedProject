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
 * Description of Transaction
 *
 * @author fabrizio.conti
 */
class TransactionController extends Controller{
    
    public $content;
    
    public $transaction;
    
    public $product;
    
    private $validationResult;
    
    private $fieldList;
    
    public function __construct($param = array(), $db_conn)
    {  
        parent::__construct($param);
        
        $this->transaction = new Models\Transaction($db_conn);
         
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
            $transactions = $this->transaction->getAllTransactions();

            foreach ($transactions as &$value) {

                $param = ["id" => $value['product_id']];

                $product = $this->product->getProduct($param);

                $value['product'] = $product[0];
            }

            $this->response = json_encode($transactions);

        } catch (\PDOException $exc) {  
            $this->response = json_encode(["status" => 0, "message" => $exc->getMessage()]);
            
            $this->response_code = 500;
        }   
    }

    public function get()
    {
        if(isset($this->param) && $this->param != '')
        {
            try {
                $param = ["id" => $this->param];

                $transaction = $this->transaction->getTransaction($param);

                $transaction = $transaction[0];

                $ausparam = ["id" => $transaction['product_id']];

                $product = $this->product->getProduct($ausparam);

                $transaction['product'] = $product[0];

                $this->response = json_encode($transaction);
                
            } catch (\PDOException $exc) {
                $this->response = json_encode(["status" => 0, "message" => $exc->getMessage()]);
                
                $this->response_code = 500;
            }
        }
    }
    
    public function delete()
    {
        try {
            $param = ["id" => $this->param];

            $this->transaction->deleteTransaction($param);
            
            $this->response = json_encode(["status" => 1, "message" => MSG_REQUEST_SUCCESS]);

        } catch (\PDOException $exc) {
            $this->response = json_encode(["status" => 0, "message" => $exc->getMessage()]);
            
            $this->response_code = 500;
        }
    }
    
    public function create()
    {
        try {
            $this->fieldList = $this->transaction->getTransactionFields();

            array_walk($this->payload, array($this, 'validateRequest'));

            if ($this->validationResult) {
                
                
   
                $this->transaction->createTransaction($this->payload);

                $this->response = json_encode(["status" => 1, "message" => MSG_REQUEST_SUCCESS]);
            }
        } catch (\PDOException $exc) {
            $this->response = json_encode(["status" => 0, "message" => $exc->getMessage()]);
            
            $this->response_code = 500;
        }
    }
}
