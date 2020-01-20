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
$actual = $_POST['actual'];
$new = $_POST['new'];
$user = $_POST['user'];

$sql1 = "select password from usuario where user_id = '$user' ";
// echo $sql1;
break;
}
$result = mysqli_query($conn, $sql1);
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
  exit;
}else{
    while($row = mysqli_fetch_assoc($result)){

        if($row['password'] == $actual){
            
            $sql2 = "UPDATE usuario SET password = '$new' WHERE usuario.user_id = '$user'" ;
            $result2 = mysqli_query($conn, $sql2) or die('error cambiando contraseña');
            if (!$result2) {
                http_response_code(404);
                die(mysqli_error($conn));
                exit;
            }else{
                  echo "ok";
              }
        }else{
            echo "no";
        }
    }
}

?>