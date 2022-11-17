<?php

class Articulo{
    public $db;

    public function __construct(){
        $this->db = new db("localhost","root","","db_proyecto");
    }
    public function index(){
        $sql = "select * from articulos";
        $result = $this->db->conexion()->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr><td>". $row["nombre"]. "</td>"."<td>". $row["descripcion"]. "</td>"."</td> <td>
              <button class='btn btn-info' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick='getData(".$row['id'].")'>Editar</button>
              <a class='btn btn-danger' href='/proyecto/index.php/deleteArticulo?id=".$row['id']."'>Eliminar</a>
          </td></tr>";
            }
          } else {
            echo "0 results";
        }

    }

    public function getArticulo($id){
        $sql = "select * from articulos where id ='$id'";
        $result = $this->db->conexion()->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){

                $obj = [
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "imagen" => $row['imagen']
                ];

                array_push($data, $obj);

                /*$data->id = $row['id'];
                $data->nombre = $row['nombre'];
                $data->descripcion = $row['descripcion'];
                $data->imagen = $row['imagen'];*/
                echo json_encode($data); 

            }
        }
    }

    public function searchArticulo($data){
        
        $sql = "select * from articulos where descripcion like'%$data%'";
        $result = $this->db->conexion()->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){

                $obj = [
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "imagen" => $row['imagen']
                ];

                array_push($data, $obj);
                echo json_encode($data); 

            }
        }
    }

    public function store($data){
        $sql = "insert into articulos VALUES('','".$data['nombre']."','".$data['descripcion']."',null)";
        $this->db->conexion()->query($sql);
        header("location:/proyecto/index.php/listararticulos");
    }

    public function storecomentario($data){
        $articuloid = $_GET['id'];
        $sql = "insert into comentarios VALUES('','".$data['comentario']."','".$_SESSION['username']."','','".$data['articuloid']."')";
        $this->db->conexion()->query($sql);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function Update($id){
        $nombre= $_POST["nombre"];
        $descripcion =$_POST["descripcion"];
        $imagen =$_POST["imagen"];
        $query = "update articulos set nombre= '$nombre', descripcion= '$descripcion', imagen= '$imagen' where id ='$id'";
        $result =  $this->db->conexion()->query($query);
        header("Location:/proyecto/index.php/listararticulos");
    }

    function delete($id){
        $query = "delete from articulos where id =".$id;
        $result =  $this->db->conexion()->query($query);
        header("Location:/proyecto/index.php/listararticulos");
    }

    function eliminarcomentario($id){
        $query = "delete from comentarios where id =".$id;
        $result =  $this->db->conexion()->query($query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function getComentarios($id){
        $sql = "select * from comentarios where articulo_id=".$id;
        $result = $this->db->conexion()->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){

                $obj = [
                    "id" => $row['id'],
                    "comentario" => $row['comentario'],
                    "usuario" => $row['usuario'],
                    "fecha" => $row['fecha']
                ];

                array_push($data, $obj);

            }
        }
        echo json_encode($data); 

    }
}
