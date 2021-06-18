<?php 
function crear($nombreUsuario)
{
    require 'database.php';

    //$stmt= $conn->prepare('SELECT Usuario FROM Usuario');
    //$sql="CALL SP_obtenerDatosCita('ClienteB')";
    $sql="CALL SP_obtenerDatosCita('$nombreUsuario')";
    $stmt= $conn->prepare($sql);
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
    $salida ="";
  
    foreach($xml->libro as $item){
        $salida .=
        "<b>Nombre:</b> " . $item->Nombre . " ".
        "<b>Correo:</b> " . $item->Correo . " ".
        "<b>Telefono:</b> " . $item->Telefono . " ".
        "<b>Fecha:</b> " . $item->Fecha . " ".
        "<b>Servicio:</b> " . $item->Servicio . " ".
        "<b>Precio:</b> $" . $item->Precio . "<hr/>";
    }
  
    echo $salida;
  }

crear("ClienteB");
leer();



?>