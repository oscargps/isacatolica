<?php
include 'conexion.php';

$conn = mysqli_connect($host,$user,$pw) or die("Error en la conexion al servidor");
mysqli_select_db($conn,$db);
if (!$conn) {
  echo "Ocurrió un error.\n";
  exit;
}
$user = $_POST['user'];
$pw = $_POST['pw'];
$query="SELECT user,password,user_id,docentes.nombre FROM usuario LEFT JOIN docentes on usuario.user_id = docentes.id WHERE usuario.user = '$user'
";
$result = mysqli_query($conn, $query);
if (!$result) {
echo "Ocurrió un error.\n";
exit;
}
$row = mysqli_fetch_array($result);
if($pw==$row[1]){
    session_start();
    $_SESSION['usuario'] = $row[0];
    $_SESSION['docente'] = $row[3];
    echo $row[3].'-true-'.$row[2];
}else{
  echo '-false-';
}
