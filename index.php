<?php
    include("db.php");
    include("Controllers/Articulo.php");  
    include("Controllers/Home.php");    
    include("Controllers/Login.php");   
    include("Controllers/Usuario.php");    
 

  
    function server(){
        $url = $_SERVER["REQUEST_URI"];
        $articulo = new Articulo();
        $home = new Home();
        $login = new Login();
        $usuario = new Usuario();

        if(isset($_GET['id'])){
        }
        else{
            $_GET['id'] = "";
        }

        if(isset($_GET['data'])){
        }
        else{
            $_GET['data'] = "";
        }
        if(isset($_GET['page'])){
        }
        else{
            $_GET['page'] = "";
        }
        
        
        session_start();


        if($url == "/proyecto/index.php/listararticulos"){
            if(isset($_SESSION["username"])){
                include("Views/admin/listararticulos.php");
            }
            else{
                include("./views/error.html");
            }
        }
        else if($url == "/proyecto/index.php/home"){
            include("Views/home.php");
        }
        else if($url == "/proyecto/index.php/home?page=".$_GET['page']){
            include("Views/home.php");
        }

        else if($url == "/proyecto/index.php/getArticulo?id=".$_GET['id']){
            $articulo->getArticulo($_GET['id']);
        }
        else if($url == "/proyecto/index.php/searchArticulo?data=".$_GET['data']){
            $articulo->searchArticulo($_GET['data']);
        }
        else if($url == "/proyecto/index.php/verArticulo?id=".$_GET['id']){
            include("Views/articulo.php");
        }
        else if($url == "/proyecto/index.php/updateArticulo?id=".$_GET['id']){
            $articulo->update($_GET['id']);
        }
        else if($url == "/proyecto/index.php/deleteArticulo?id=".$_GET['id']){
            $articulo->delete($_GET['id']);
        }
        else if($url == "/proyecto/index.php/login"){
            $login->index();
        }
        else if($url == "/proyecto/index.php/logout"){
            $login->logout();
        }
        else if($url == "/proyecto/index.php/checklogin"){
            $login->checklogin($_POST);
        }
        elseif($url == "/proyecto/index.php/login?msg=error"){
            include("./Views/loginError.php");
        }
        else if($url == "/proyecto/index.php/registrarusuario"){
            include("Views/registroUsuario.php");
        }
        else if($url == "/proyecto/index.php/storeusuario"){
            $usuario->store($_POST);
        }
        else if($url == "/proyecto/index.php/storecomentario"){
            $articulo->storecomentario($_POST);
        }
        
        else if($url == "/proyecto/index.php/getcomentarios?id=".$_GET['id']){
            $articulo->getcomentarios($_GET['id']);
        }
        else if($url == "/proyecto/index.php/eliminarcomentario?id=".$_GET['id']){
            $articulo->eliminarcomentario($_GET['id']);
        }
        if($url == "/proyecto/index.php/creararticulo"){
            $articulo->store($_POST);
            echo $_POST["nombre"];
        }
        

       
    }

    server();
?>
