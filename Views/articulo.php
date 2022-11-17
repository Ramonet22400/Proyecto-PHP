<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Producto</title>
        <!-- CSS only -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="../assets/css/home.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    </head>
    <body>
    <?php include('C:\xampp\htdocs\proyecto\Views\layouts\navbar.php'); ?>
        <main class="container mt-5">
        <input type="hidden" id="rol" value="<?php if(isset($_SESSION['rol'])) echo $_SESSION['rol'] ?>">
            <section class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <input type="hidden" id="id" value="<?php echo $_GET['id'];?>">
                    <div class="text-center">
                        <h1 class="mb-5" id="nombre"></h1>
                        <img id="imagen" src=""/> 
                    </div> 
                    
                    <p id="descripcion">
                    </p>  
                </div>
                <div class="col-md-1"></div>
            </section>
            <section> 
                <div class="col-md-6">
                    <form method="post" id="formcoment" action="/proyecto/index.php/storecomentario">
                        <h4>Comentar</h4>
                        <input type="hidden" id="username" value="<?php if(isset($_SESSION['username'])) echo $_SESSION['username'] ?>">
                        <input type="hidden" id="articuloid" name="articuloid" value="<?php echo $_GET['id']?>">
                        <textarea class="form-control mb-2" name="comentario"></textarea>
                        <button  type="submit" class="btn btn-success mb-2">Comentar</button>
                    </form>

                    <div id="comentarios" class="card shadow-lg p-3">
                       
                    </div>
                </div>
            </section>
        </main>
        <?php include('C:\xampp\htdocs\proyecto\Views\layouts\footer.html'); ?>

        <script>
            function getData(){
                var id = document.getElementById('id').value;

                $.ajax({
                    type : "GET",
                    url : "/proyecto/index.php/getArticulo?id="+id,
                    success : function(data){
                        data = JSON.parse(data)[0];

                        
                        document.getElementById('nombre').innerHTML = data.nombre;
                        document.getElementById('descripcion').innerHTML = data.descripcion;
                        document.getElementById('imagen').src = data.imagen;
                        
                    }
                });
            }

            getData();

            function getComentarios(){
                if(document.getElementById("username").value == ""){
                    document.getElementById("formcoment").style.display = "none";
                }

                var id = document.getElementById('articuloid').value;
                $.ajax({
                    type : "GET",
                    url : "/proyecto/index.php/getcomentarios?id="+id,
                    success : function(data){
                        data = JSON.parse(data);
                        console.log(data);

                        data.forEach(element =>{
                            if(element.usuario ==  document.getElementById("username").value || document.getElementById("rol").value == "admin"  ){
                                document.getElementById("comentarios").innerHTML +=`
                                <a class="text-danger" href='/proyecto/index.php/eliminarcomentario?id=${element.id}'>Eliminar</a>
                                <h4 id="usuario">${element.usuario}</h4>
                                <span id="fecha">${element.fecha}</span>
                                <p id="comentario">${element.comentario}</p>
                                <hr>
                            `
                            }
                            else{
                                document.getElementById("comentarios").innerHTML +=`
                                <h4 id="usuario">${element.usuario}</h4>
                                <span id="fecha">${element.fecha}</span>
                                <p id="comentario">${element.comentario}</p>
                                <hr>
                            `
                            }
                           
                        })

                      
                        
                    }
                });
            }

            getComentarios();

           

        </script>
    </body>
</html>

