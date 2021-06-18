<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        
    }else{
        if($_SESSION['rol'] == 0){
            header('location: cliente.php');
        }else if($_SESSION['rol'] == 1){
          
            header('location: admin.php');
        }
    }

    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 
    
        // destroy the session 
        session_destroy(); 
        header('location: index.php');
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title >Proyecto Programacion 2
    </title>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php"><p>Dentista</p></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><p>Inicio</p></a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="registroCita.php"><p>Registrar Cita</p></a>
        </li>
        </ul>
            <form class="d-flex">
              <button class="switch" id="switch">
                <span><i class="fas fa-sun"></i></span>
                <span><i class="fas fa-moon"></i></span>
              </button>
            </form>
      
      </div>
  </div>
</nav>



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






<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/node_modules/@popperjs\core/dist/umd/popper.min.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/js/main.js"></script>
</body>

</html>