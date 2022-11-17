<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
    <?php include('C:\xampp\htdocs\proyecto\Views\layouts\navbar.php'); ?>
        <main class="container mt-5">
            <section class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card p-5 shadow-lg">
                        <h1>Registese</h1>
                        <form method="post" action="/proyecto/index.php/storeusuario">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Nombre de usuario</label>
                                <input type="text" name="user" class="form-control" id="usuario">
                            </div>
                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="contraseña" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Registrese</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </section>
        </main>
        <?php include('C:\xampp\htdocs\proyecto\Views\layouts\footer.html'); ?>
    </body>
</html>

