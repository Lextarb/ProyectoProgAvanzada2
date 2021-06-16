<!DOCTYPE html>
<html>
<head>
    <title >Proyecto Programacion 2
    </title>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
<div>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><p>Dentista</p></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#"><p>Inicio</p></a>
        </li>
        <li class="nav-item">
            <button class="switch" id="switch">
                <span><i class="fas fa-sun"></i></span>
                <span><i class="fas fa-moon"></i></span>
            </button>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>

<div class="container">
  <!-- Content here -->
  <div class="row ">
    <div class="col col-lg-12">
        <br>
        <h1>Porfavor inicie sesion o registrese!</h1>
        <br>
        <button type="button" class="btn btn-primary"><a href="login.php"><p> Inicar Sesion</p></a></button> 
        <button class="btn btn-outline-primary"><a href="register.php"><p>Registrarse</p></a></button>
    </div>
    
  </div>


</div>





<script src="/js/main.js"></script>
<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/node_modules/@popperjs\core/dist/umd/popper.min.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>