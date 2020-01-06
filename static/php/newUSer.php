<?php
include('conexion.php');
error_reporting(E_ALL ^ E_NOTICE);
$conn = mysqli_connect($host,$user,$pw) or die("Error en la conexion al servidor");
mysqli_select_db($conn,$db);
$ok1 = false;
$ok2 = false;
if (!$conn) {
  echo "Ocurrió un error.\n";
  exit;
}
switch ($method) {
case 'POST':
$id = $_POST['id'];
$name = $_POST['name'];
$area = $_POST['area'];
$mail = $_POST['mail'];
$tel = $_POST['tel'];

$sql1 = "insert into docentes(id,nombre,cargo,correo,telefono) values ('$id','$name','$area','$mail','$fecha')";
//echo $sql1;
break;
}
$result = mysqli_query($conn, $sql1);
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
  exit;
}else{
    $ok1 = true;
    $sql2 = "insert into usuario(user,password,user_id) values ('$id','$id','$id')";
    $result2 = mysqli_query($conn, $sql2);
    if (!$result2) {
        http_response_code(404);
        die(mysqli_error($conn));
        exit;
      }else{
          $ok2= true;
      }
}
if( $ok1 && $ok2){
    echo "ok";
}else{
    echo "error";
}
?>