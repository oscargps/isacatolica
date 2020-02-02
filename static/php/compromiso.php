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
  case 'GET':
  $id=$_GET['id'];
  $sql="SELECT estudiante.nombre,asunto,compromiso,compromiso.fecha,TIME_FORMAT(compromiso.fecha,'%r'),compromiso.id
  FROM compromiso
  INNER JOIN estudiante
  ON estudiante.id = compromiso.estudiante".($id?" where compromiso.id='$id'":'');
break;
case 'POST':
$estudiante = $_POST['estudiante'];
$asunto = $_POST['asunto'];
$compromiso = $_POST['compromiso'];
$sql = "insert into compromiso(estudiante,asunto,compromiso,docente) values ('$estudiante','$asunto','$compromiso','1063300726')";
echo $sql;
break;
}
$result = mysqli_query($conn, $sql);
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
  exit;
}
if ($method == 'GET') {
  $json=array();
  while ($row = mysqli_fetch_array($result)) {
      $json[]=array(
        'estudiante'=>$row[0],
          'asunto'=>$row[1],
          'compromiso'=>$row[2],
          'creado'=>$row[3],
        'id'=>$row[5]

      );
      //echo $row[0];
    }
    $jsons=json_encode($json);
    echo $jsons;
}
?>