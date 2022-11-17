<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <input class="form-control me-2" id="searchdata" onchange="searchData()" type="search" placeholder="Search" aria-label="Search">
          </li>
         
          <?php 
            if(isset($_SESSION["username"])){
              echo "<li class='nav-item dropdown'>".
                "<a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>".
                $_SESSION["username"].
                "</a>".
                "<ul class='dropdown-menu'>".
                  "<li><a class='dropdown-item' href='/proyecto/index.php/logout'>Salir</a></li>".
                "</ul>".
              "</li>";
            }else{
              echo "<li class='nav-item ms-4'>".
              "<a class='nav-link active' aria-current='page' href='login'>Login</a>".
              "</li>";
            }
         
          ?>

      
      </div>
    </div>
  </nav>