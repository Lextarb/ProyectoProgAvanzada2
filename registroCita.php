<?php

    include_once 'database.php';
    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: login.php)');
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

    if(isset($_POST['username']) && isset($_POST['servicio']) && isset($_POST['fecha']) && isset($_POST['hora'])){
        $username = $_POST['username'];
        $servicio = $_POST['servicio'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $cita = $fecha." ".$hora;
        //echo"<script>alert('".$cita."');</script>";
    
        $query = $db->connect()->prepare("CALL SP_agregarCita(:username,:servicio,:cita)");
	    $query->execute([':username' => $username, ':servicio' => $servicio, ':cita' => $cita]);

	    $row = $query->fetch(PDO::FETCH_NUM);
	
	    if($row == true){
		    $rol = $row[0];
		    if($rol==0){
		    	echo"<script>alert('La fecha no ha sido ingresada correctamente!'); </script>";
		    }else if($rol== 1){
			    echo"<script>alert('Se ha registrado su cita correctamente!'); </script>";
		    }
		
	    }else{
		    // no existe el usuario
		    echo "</script>Error</script>";
	    }










    }
        
    


    

    
?>


<!DOCTYPE html>
<html>
<head>
    <title >Proyecto Programacion 2
    </title>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css">
    
    <link rel="stylesheet" href="dist/bootstrap-clockpicker.min.css">
    
    <script type="text/javascript">
        function ShowSelected()
        {
            /* Para obtener el valor */
            var cod = document.getElementById("servicio").value;

            //alert(cod);
 
            /* Para obtener el texto */
            var combo = document.getElementById("servicio");
            var selected = combo.options[combo.selectedIndex].text;
            //alert(selected);
        }
    </script>


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
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="logout.php"><p style="color:#3498DB">Cerrar Sesion</p></a>
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
                                <label for="username"><p>Usuario(Tu cuenta)</p></label><br>
                                <input id="username" type="text" class="form-control" name="username" required autofocus value="<?php echo $_SESSION['username'] ?>" readonly>
                                
                            </div>
                           <br>

                            <div class="input-group mb-3">
                                <br>
                                <label class="input-group-text" for="servicio" >Servicios a elegir</label>
                                <select class="form-select" id="servicio" onchange="ShowSelected();" name="servicio">
                                <?php foreach ($data as $row):
                                    echo '<option value="'.$row["nombreServicio"].'">'.$row["nombreServicio"].'</option>';
                                    endforeach;
                                ?>
                                </select>
                            </div>
                            
                            
                            
                            <div class="form-group">
                                <label for="fecha"><p>Fecha y Hora de la Cita</p></label><br>
                                
                                
                                <div class="input-group date datepicker" data-provide="datepicker" name="fecha">
                                    <input id="fecha" type="text" class="form-control" required name="fecha">
                                    <div class="input-group-addon">
                                    <span class="form-control btn-secondary"><i class="fas fa-calendar-day"></i></span>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group clockpicker" name="hora">
                                    <input id="hora" type="text" class="form-control" value="09:30" name="hora">
                                    <span class="input-group-addon">
                                    <span class="form-control btn-secondary"><i class="far fa-clock"></i></span>
                                </span>
                                </div>



                                
                            </div>
                            
                            <br>


                            <br>


                            <div class="form-group m-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Registrar Cita
                                </button>
                            </div>
                            
                        </form>
                    </div>
                
                
                </div>
            
        </div>
    
</div>


</div>


    
    

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/@popperjs\core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/bootstrap-datepicker.min.js"></script>
    <script src="/locales/bootstrap-datepicker.es.min.js"></script>        
    <script>
        $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language:'es',
        daysOfWeekDisabled: '0,6',
        todayHighlight: true,
        weekStart: '0',
        startDate: new Date()
        });
    </script>
    
    <script src="/dist/bootstrap-clockpicker.min.js"></script>

    <script>
        $('.clockpicker').clockpicker({
            donetext: "Elegir hora",
            placement: 'bottom',
            autoclose: true,
        });
    </script>

</body>

</html>