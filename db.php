<?php
define('NUM_ITEMS_BY_PAGE', 3);

class db{
    public $host;
    public $dbname;
    public $user;
    public $password;

    
    public function __construct($host,$dbname,$user,$password){
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function conexion(){
        $conn = new mysqli($this->host,"root","","db_proyecto");
        return $conn;
    }

}