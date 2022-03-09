<?php

    class Database{

        //DB connect
        public function connect()
        {
            $this->conn=null;
            try{
                $this->conn=new PDO('mysql:dbname=api;host=localhost','root','');
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connect error '.$e->getMessagge();
            }
            
            return $this->conn;
        }
    }
?>