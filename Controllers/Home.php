<?php
class Home{
    public $db;

    public function __construct(){
        $this->db = new db("localhost","root","","db_proyecto");
    }
    public function index($start){
        $sql = 'select * from articulos order by id asc LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE;
        $result = $this->db->conexion()->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<div class='col-md-12' onclick='verArticulo(".$row['id'].")'>".
              "<div class='card p-5 mb-5'>".
                  "<div class='row'>".
                      "<h2>".$row["nombre"]."</h2>".
                      "<div class='col-md-6'>".
                          "<img src='".$row["imagen"]."' width='200px' />".
                      "</div>".
                      "<div class='col-md-6'>".
                          "<p>".$row['descripcion']."</p>".
                      "</div>".
                  "</div>".
              "</div>".
          "</div>";
            }
          } else {
            echo "0 results";
        }
    }
}