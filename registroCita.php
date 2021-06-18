<?php

    include_once 'database.php';
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

    $db = new Database();
	$querylista = $db->connect()->prepare("CALL SP_serviciosSelect()");
	$querylista->execute();

	$data = $querylista->fetchAll();

    
?>


<!DOCTYPE html>
<html>
<head>
    <title >Proyecto Programacion 2
    </title>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    
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
          <a class="nav-link" aria-current="page" href="index.php"><p>Inicio</p></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="registroCita.php"><p>Registrar Cita</p></a>
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
  <br>
	
    <div class="d-flex flex-column justify-content-between" >
        
            <div class="card d-lg-flex">
                
                
                    <div class="card-body">
                        <h4>Registro de Cita</h4>
                        <form method="POST" class="my-login-validation" novalidate="">
                            <div class="form-group">
                                <label for="name"><p>Usuario(Tu cuenta)</p></label><br>
                                <input id="name" type="text" class="form-control" name="name" required autofocus value="<?php echo $_SESSION['username'] ?>" readonly>
                                
                            </div>
                           <br>

                            <div class="input-group mb-3">
                                <br>
                                <label class="input-group-text" for="inputGroupSelect01">Servicios a elegir</label>
                                <select class="form-select" id="inputGroupSelect01">
                                <?php foreach ($data as $row):
                                    echo '<option value="'.$row["idServicio"].'">'.$row["nombreServicio"].'</option>';
                                    endforeach;
                                ?>
                                </select>
                            </div>
                            
                            
                            
                            <div class="form-group">
                                <label for="cuenta"><p>Fecha y Hora de la Cita</p></label><br>
                                <input id="cuenta" type="text" class="form-control" name="cuenta" required>
                                
                            </div>
                            
                            <br>


                            <div class="form-group m-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Registrar
                                </button>
                            </div>
                            <div class="mt-4 text-center">
                                Ya tienes una cuenta? <a href="login.php">Inicio de Sesi&#243;n</a>
                            </div>
                        </form>
                    </div>
                
                
                </div>
            
        </div>
    
</div>







</div>







    <script src="/node_modules/@popperjs\core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>

