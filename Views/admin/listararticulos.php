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
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php include('C:\xampp\htdocs\proyecto\Views\layouts\navbar.php'); ?>
        <main class="container mt-5">
            <section class="row">
                <h1 class="text-center">Listado Articulos</h1>
                
                <div class="col-md-12">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir</button>
                   <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                                $articulo = new Articulo();
                                $articulo->index();
                           ?>
                        </tbody>
                   </table>
                </div>
            </section>
            <?php include('C:\xampp\htdocs\proyecto\Views\admin\partials\form-product.html'); ?>
        </main>
        <?php include('C:\xampp\htdocs\proyecto\Views\layouts\footer.html'); ?>

        <script>
            function getData(id){
                $.ajax({
                    type : "GET",
                    url : "/proyecto/index.php/getArticulo?id="+id,
                    success : function(data){
                        data = JSON.parse(data)[0];

                        document.getElementById('nombre').value = data.nombre;
                        document.getElementById('descripcion').value = data.descripcion;
                        document.getElementById('imagen').value = data.imagen;

                        document.getElementById('formProd').action = "/proyecto/index.php/updateArticulo?id="+data.id
                        
                    }
                });
            }

           

        </script>
    </body>
</html>


