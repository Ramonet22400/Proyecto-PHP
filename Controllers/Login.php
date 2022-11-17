<?php
    class Login{
        public $db;

        public function __construct(){
            $this->db = new db("localhost","root","","db_proyecto");
        }

        function Index(){
           include("./views/login.php");
        }
        
        function loginError(){
            header("location:/proyecto/index.php/loginError");
        }
        function Create(){
            include("./views/crearnoticias.php");
        }
        function checklogin($data){
            

            $user= $data["user"];
            $password= $data["password"];
            
            $sql = "select * from users where usuario= '$user' and contrasena= '$password'";
            $result = $this->db->conexion()->query($sql);
            echo $result->num_rows; 
            if($result->num_rows > 0){
                ob_start();
                session_start();
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                while($row = $result->fetch_assoc()) {
                    $_SESSION['username'] = $user;
                    $_SESSION['rol'] = $row['rol'];
                    if($_SESSION['rol'] == "admin"){
                        header("location:/proyecto/index.php/listararticulos");
                    }
                    else if($_SESSION['rol'] == "guest"){
                        header("location:/proyecto/index.php/home");
                    }
                }
            }
            else{
                echo "Contrasena invalida";
                header("location:/proyecto/index.php/login?msg=error");
            }
            
        }
        function Edit($id){
                
            $database = new Database();
            $query = "select * from noticias WHERE id ='$id'";
            $result =  $database->conexion()->query($query);
            if($result->num_rows > 0 ){
                while($row = $result->fetch_assoc()){
                    return $row; 
            }
            
        }
       
        }
    
        function Update(){
            $id=$_GET['id'];
            $titulo=$_POST["titulo"];
            $contenido=$_POST["contenido"];
            $portada=$_POST["portada"];
            $database = new Database(); 
            $query = "update noticias set titulo= '$titulo', contenido= '$contenido', portada= '$portada' where id ='$id'";
            $result =  $database->conexion()->query($query);
            header("Location:/noticias/index.php/listarnoticias ");
        }
        function logout(){
           // remove all session variables
            session_unset();
            
            // destroy the session
            session_destroy();
            
            header("location:/proyecto/index.php/login");
        }
    }
?>