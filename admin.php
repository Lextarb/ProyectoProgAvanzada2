<?php
    
    require 'database.php';

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
    
//--------------------
function crear()
{
    //require 'database2.php';

    //$stmt= $conn->prepare('SELECT Usuario FROM Usuario');
    //$sql="CALL SP_obtenerDatosCita('ClienteB')";
    //$sql="CALL SP_obtenerDatosCita('$nombreUsuario')";

    $db = new Database();
    //$querylista = $db->connect()->prepare("CALL SP_serviciosSelect()");
    //$querylista->execute();

    $sql="CALL obtenerDatosCita2()";

    $stmt= $db->connect()->prepare($sql);
    //$stmt->bindParam(':usuario',Cliente1);
    $stmt->execute();

    $xml = new DomDocument('1.0', 'UTF-8');

    $biblioteca = $xml->createElement('biblioteca');
    $biblioteca = $xml->appendChild($biblioteca);

    while($resultado = $stmt ->fetch())   
    {
        $libro = $xml->createElement('libro');
        $libro = $biblioteca->appendChild($libro);
 
        $nodo_nombre = $xml->createElement('Nombre',$resultado["Nombre"]);
        $nodo_nombre = $libro->appendChild($nodo_nombre);      

        $nodo_correo = $xml->createElement('Correo',$resultado["Correo"]);
        $nodo_correo = $libro->appendChild($nodo_correo); 

        $nodo_telefono = $xml->createElement('Telefono',$resultado["Telefono"]);
        $nodo_telefono = $libro->appendChild($nodo_telefono); 

        $nodo_Fecha = $xml->createElement('Fecha',$resultado["Fecha"]);
        $nodo_Fecha = $libro->appendChild($nodo_Fecha); 
       
        $nodo_nombreServicio = $xml->createElement('Servicio',$resultado["nombreServicio"]);
        $nodo_nombreServicio = $libro->appendChild($nodo_nombreServicio); 

        $nodo_Precio = $xml->createElement('Precio',$resultado["Precio"]);
        $nodo_Precio = $libro->appendChild($nodo_Precio); 
    }


    $xml->formatOutput = true;
    $el_xml = $xml->saveXML();
    $xml->save('libros.xml');
    //Mostramos el XML puro
    /*echo "<p><b>El XML ha sido creado.... Mostrando en texto plano:</b></p>".
    htmlentities($el_xml)."<hr>";*/


}
function leer(){
    echo "<p><b>Citas agendadas</b></p>";
  
    $xml = simplexml_load_file('libros.xml');
    $salida ='<table class="table">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Telefono</th>
        <th scope="col">Fecha</th>
        <th scope="col">Servicio</th>
        <th scope="col">Precio</th>
      </tr>
    </thead><tbody>';
  
    foreach($xml->libro as $item){
        $salida .='
        <tr>
          <th scope="row"><p>'.$item->Nombre.'</p></th>
          <td><p>'.$item->Correo.'</p></td>
          <td><p>'.$item->Telefono.'</p></td>
          <td><p>'.$item->Fecha.'</p></td>
          <td><p>'.$item->Servicio.'</p></td>
          <td><p>'.$item->Precio.'</p></td>
        </tr>';

    }
    $salida .='</tbody>
    </table>';

    echo $salida;
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
  <?php 
        crear();
        leer();
    ?>

</div>






<script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/@popperjs\core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/node_modules/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
</body>

</html>