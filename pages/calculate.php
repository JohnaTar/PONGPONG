<?php
class Database {
 
       private $host = 'localhost'; //ชื่อ Host 
       private $user = 'root'; //ชื่อผู้ใช้งาน ฐานข้อมูล
       private $password = ''; // password สำหรับเข้าจัดการฐานข้อมูล
       private $database = 'kpis'; //ชื่อ ฐานข้อมูล
 
    //function เชื่อมต่อฐานข้อมูล
    protected function connect(){
        
        $mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
            
            $mysqli->set_charset("utf8");
 
            if ($mysqli->connect_error) {
 
                die('Connect Error: ' . $mysqli->connect_error);
            }
 
        return $mysqli;
    }
    
  }
  
?>