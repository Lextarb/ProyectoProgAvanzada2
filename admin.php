<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: login.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: login.php');
        }
    }

    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 
    
        // destroy the session 
        session_destroy(); 
        header('location: login.php');
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
          <a class="nav-link active" aria-current="page" href="admin.php"><p>Inicio</p></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="registroCita.php"><p>Registrar Cita</p></a>
        </li>
        <div>
           
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
 

</div>






<script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/@popperjs\core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/node_modules/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
</body>

</html>