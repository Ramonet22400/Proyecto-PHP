<?php 
$db = new db("localhost","root","","db_proyecto");
$result = $db->conexion()->query('SELECT COUNT(*) as total_products FROM articulos');
$row = $result->fetch_assoc();
$num_total_rows = $row['total_products'];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <!-- CSS only -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="../assets/css/home.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include('C:\xampp\htdocs\proyecto\Views\layouts\navbar.php'); ?>
        <header class="header-banner">
        
        </header>
        <main class="container mt-5">
            <section class="row">
                <h1 class="text-center">Ultimos Articulos</h1>
                <div id="articles">
                <?php 
                    if ($num_total_rows > 0) {
                        $page = false;
                    
                        //examino la pagina a mostrar y el inicio del registro a mostrar
                        if (isset($_GET["page"])) {
                            $page = $_GET["page"];
                        }
                    
                        if (!$page) {
                            $start = 0;
                            $page = 1;
                        } else {
                            $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
                        }

                        $total_pages = ceil($num_total_rows / NUM_ITEMS_BY_PAGE);
                    
                        $articulo = new Home();
                        $articulo->index($start);
                    
                        echo '<nav>';
                        echo '<ul class="pagination">';
                    
                        if ($total_pages > 1) {
                            if ($page != 1) {
                                echo '<li class="page-item"><a class="page-link" href="home?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
                            }
                    
                            for ($i=1;$i<=$total_pages;$i++) {
                                if ($page == $i) {
                                    echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="home?page='.$i.'">'.$i.'</a></li>';
                                }
                            }
                    
                            if ($page != $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="home?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
                            }
                        }
                        echo '</ul>';
                        echo '</nav>';
                    }
                ?>
                
                </div>
            </section>
        </main>
        <?php include('C:\xampp\htdocs\proyecto\Views\layouts\footer.html'); ?>

        <script>
            function verArticulo(id){
                location.href = "/proyecto/index.php/verArticulo?id="+id;
            }

            function searchData(){
                var data = document.getElementById('searchdata').value;
                console.log(data);

                $.ajax({
                    type : "GET",
                    url : "/proyecto/index.php/searchArticulo?data="+data,
                    success : function(data){
                        data = JSON.parse(data);

                        data.forEach(element =>{
                            document.getElementById("articles").innerHTML = `
                            <div class='col-md-12' onclick='verArticulo(${element.id})'>
                                <div class='card p-5 mb-5'>
                                    <div class='row'>
                                        <h2>${element.nombre}</h2>
                                        <div class='col-md-6'>
                                        <img src='${element.imagen}' width='200px' />
                                        </div>
                                        <div class='col-md-6'>
                                            <p>${element.descripcion}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `
                        })
                       
                        
                    }
                });
            }        
        </script>
    </body>
</html>

