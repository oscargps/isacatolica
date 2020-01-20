<?php
include('conexion.php');
error_reporting(E_ALL ^ E_NOTICE);
$conn = mysqli_connect($host,$user,$pw) or die("Error en la conexion al servidor");
mysqli_select_db($conn,$db);

if (!$conn) {
  echo "Ocurrió un error.\n";
  exit;
}
switch ($method) {
case 'POST':
$data = $_POST['data'];
$director = $_POST['director'];
$datos = explode(',',$data);
if (!($datos[0]== 'IDENTIFICACION')) {
  $sql1 = "insert into estudiante(id,nombre,nivel,telefono,director,acudiente) values ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$director','$datos[4]')";
}else{
  return;
}
// echo $sql1;
break;
}
$result = mysqli_query($conn, $sql1);
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
  exit;
}else{
    echo 'ok-'.$datos[1];
}

?>