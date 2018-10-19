<?php

namespace MyNamespace;

use PDO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connect
 *
 * @author fabrizio.conti
 */
class Connect {
    
    private $conn = null;
    
    protected static $instance = null;
    
    protected function __construct($config) {

        try {
            $hostname = $config['host'];
            $dbname = $config['database'];
            $user =$config['user'];
            $pass = $config['password'];
            
            $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass, array(PDO::ATTR_PERSISTENT => true));

        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public static function getInstance($config)
    {

        if(self::$instance === null)
        {
            self::$instance = new Connect($config);
        }
        
        return self::$instance;
    }
    
    public function query($sql) 
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\PDOException $exc) {
            throw $exc;
        }
        return $rows;
    }

    public function queryBind($sql, array $params_ay) {
        
        $rows = [];
        
        try {
            $stmt = $this->conn->prepare($sql);

            foreach ($params_ay as $key => $value) {

                if (is_numeric($value)) {
                    $alias_key = ":" . $key;

//                echo "BINDING INT $alias_key --> $value<br>";

                    $stmt->bindParam($alias_key, $params_ay[$key], PDO::PARAM_INT);
                } else if (is_string($value)) {
                    $alias_key = ":" . $key;

//                echo "BINDING STRING $alias_key --> $value<br>";

                    $stmt->bindParam($alias_key, $params_ay[$key], PDO::PARAM_STR);
                }
            }


            $result = $stmt->execute();

            if($result)
            {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            else 
            {
                $rows = ["status" => 0, "message" => "query failed!"];
            }
            
            
        } catch (\PDOException $ex) {
            throw $ex;
        }
        
        return $rows;
    }
    
    public function getTableFields($tableName)
    {
        try {
            $stmt = $this->conn->prepare("DESCRIBE $tableName");
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);

        } catch (\PDOException $exc) {
            throw $exc;
        }
        return $rows;
    }
    

}
