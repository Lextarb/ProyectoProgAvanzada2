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
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    
	<script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="js/login.js"></script>
</head>

<body>

<div class="container">

<br>
	
		<div class="d-flex flex-column justify-content-between" >
			
				<div class="card d-lg-flex">
					<div class="card-img-top" >
						<img src="img/logo.jpg" alt="logo" >
					</div>
					
						<div class="card-body">
							<h4 class="card-title">Inicio de Sesi&#243;n</h4>
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
    

<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>




