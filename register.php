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

if(isset($_POST['cuenta']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['numero']) ){
	$username = $_POST['cuenta'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$numero = $_POST['numero'];



	$db = new Database();
	$query = $db->connect()->prepare("CALL SP_agregarUsuario(:username,:password,:name,:email,:numero)");
	$query->execute([':username' => $username, ':password' => $password, ':name' => $name, ':email' => $email, ':numero' => $numero]);

	$row = $query->fetch(PDO::FETCH_NUM);
	
	if($row == true){
		$rol = $row[0];
		if($rol==0){
			echo"<script>alert('El usuario ya existe'); window.location= 'register.php'</script>";
		}else if($rol== 1){
			echo"<script>alert('Se ha registrado con exito!'); window.location= 'register.php'</script>";
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
    <title >Registro
    </title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    
	<script src="/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="js/login.js"></script>
</head>

<div class="container">

<br>
	
		<div class="d-flex flex-column justify-content-between" >
			
				<div class="card d-lg-flex">
					<div class="card-img-top" >
						<img src="img/logo.jpg" alt="logo" >
					</div>
					
						<div class="card-body">
							<h4 class="card-title">Registro</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="name">Nombre</label><br>
									<input id="name" type="text" class="form-control" name="name" required autofocus>
									
								</div>
                               

                                <div class="form-group">
									<label for="numero">Numero Telefono</label><br>
									<input id="numero" type="tel" class="form-control" name="numero" required>
									
								</div>
                                
                                <div class="form-group">
									<label for="cuenta">Cuenta</label><br>
									<input id="cuenta" type="text" class="form-control" name="cuenta" required>
									
								</div>
                                

								<div class="form-group">
									<label for="email">Correo electr&#243;nico</label><br>
									<input id="email" type="email" class="form-control" name="email" required>
									
								</div>

                               
								<div class="form-group">
									<label for="password">Contrase&#241;a</label><br>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									
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

<div class="modal fade" id="Modelito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>




