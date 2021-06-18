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



	if(!empty($username) && !empty($password) && !empty($name)&& !empty($email) && !empty($numero))
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo "Esta dirección de correo ($email) es válida.";
			$db = new Database();
			$query = $db->connect()->prepare("CALL SP_agregarUsuario(:username,:password,:name,:email,:numero)");
			$query->execute([':username' => $username, ':password' => $password, ':name' => $name, ':email' => $email, ':numero' => $numero]);

			$row = $query->fetch(PDO::FETCH_NUM);
	
			if($row == true)
			{
				$rol = $row[0];
				if($rol==0)
				{
					echo"<script>alert('El usuario ya existe'); window.location= 'register.php'</script>";
				}else if($rol== 1)
				{
				echo"<script>alert('Se ha registrado con exito!'); window.location= 'register.php'</script>";
				}
		
		
			}else
			{
				// no existe el usuario
				echo "<script>alert('Error!');</script>";
			}
		}
		else
		{
			//echo "<script>alert('Error!Esta dirección de correo ($email) no es válida.');</script>";
			echo "Esta dirección de correo ($email) no es válida.";
		}

		
	}
	else
	{
		echo 'Llene todos los campos';
		
	}
	

}

?>


<!DOCTYPE html>
<html>
<head>
    <title >Registro
    </title>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="js/login.js"></script>

	<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	
</head>

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
							<h4 class="card-title" style="color: #000;">Registro</h4>
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


<script src="/js/main.js"></script>
</body>

</html>




