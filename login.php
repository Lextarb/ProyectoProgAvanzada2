<?php 
include_once 'database.php';
session_start();

if(isset($_GET['cerrar_sesion'])){
	session_unset(); 

	// destroy the session 
	session_destroy(); 
	header('location: login.php');
}

if(isset($_SESSION['rol'])){
	switch($_SESSION['rol']){
		case 1:
			header('location: admin.php');
		break;

		default:
		header('location: cliente.php');
		break;
	}
}

if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$db = new Database();
	$query = $db->connect()->prepare("CALL SP_loginSelect(:username,:password)");
	$query->execute([':username' => $username, ':password' => $password]);

	$row = $query->fetch(PDO::FETCH_NUM);
	
	if($row == true){
		$rol = $row[3];
		$_SESSION['rol'] = $rol;
		$_SESSION['username'] = $username;

		switch($rol){
			case 1:
				header('location: admin.php');
			break;

			default:
			header('location: cliente.php');
			break;
		}
	}else{
		// no existe el usuario
		echo"<script>alert('Nombre de usuario o contraseña incorrecto'); window.location= 'login.php'</script>";
	}
	

}

?>


<!DOCTYPE html>
<html>
<head>
    <title >Iniciar Sesi&#243;n
    </title>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
    
	<script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="js/login.js"></script>
	
	
	<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	
</head>

<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php"><p>Dentista</p></a>
    <button class="navbar-toggler  navbar-light bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><p>Inicio</p></a>
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

<br>
	
		<div class="d-flex flex-column justify-content-between" >
			
				<div class="card d-lg-flex">
					<div class="card-img-top" >
						<img src="img/logo.jpg" alt="logo" >
					</div>
					
						<div class="card-body">
							<h4 class="card-title" style="color: #000;">Inicio de Sesi&#243;n</h4>
							<form action="#" method="POST" class="my-login-validation">
								<div class="form-group">
									<label >Cuenta</label><br>
									<input id="username" type="text" class="form-control" name="username" value="" required autofocus>
									
								</div>
                                
								<div class="form-group">
									<label for="password">Contrase&#241;a</label><br>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    
								</div>

                                <br>
								<div class="form-group m-0">
                                    
									<button type="submit" class="btn btn-primary btn-block">
										Iniciar Sesi&#243;n
									</button>
								</div>
								<div class="mt-4 text-center">
									No tienes cuenta? <a href="register.php">Crear Cuenta</a>
								</div>
							</form>
						</div>
					
					
				</div>
			
		</div>
	
</div>
    
<script src="/js/main.js"></script>
</body>

</html>




