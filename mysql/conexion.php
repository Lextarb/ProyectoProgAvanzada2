<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion = "192.185.131.135";
$database_conexion = "javierc1_17100199";
$username_conexion = "javierc1_admin";
$password_conexion = "TECJ@vier";
$conexion = mysql_pconnect($hostname_conexion, $username_conexion, $password_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
?>