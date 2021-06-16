<!DOCTYPE html>
<html>
<head>
    <title >Registro
    </title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css">
	<script src="js/login.js"></script>
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.jpg" alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Registro</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="name">Nombre</label><br>
									<input id="name" type="text" class="form-control" name="name" required autofocus>
									
								</div>
                               

                                <div class="form-group">
									<label for="name">Numero Telefono</label><br>
									<input id="numero" type="tel" class="form-control" name="numero" required>
									
								</div>
                                
                                <div class="form-group">
									<label for="name">Cuenta</label><br>
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
					<div class="footer">
						Copyright &copy; 2017 &mdash; Dentista
					</div>
				</div>
			</div>
		</div>
	</section>

    
<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>




