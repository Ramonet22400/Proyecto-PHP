<?php

class Usuario{
    public $db;

    public function __construct(){
        $this->db = new db("localhost","root","","db_proyecto");
    }
    public function store($data){
        $sql = "insert into users VALUES('','".$data['user']."','".$data['password']."','guest')";
        $this->db->conexion()->query($sql);
        header("location:/proyecto/index.php/login");
    }

   
}
