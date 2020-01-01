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
  $id= $_GET['id'];
  $sql="SELECT creado,estudiante.nombre,permiso.grado,motivo,permiso.fecha,permiso.id
  FROM permiso
  INNER JOIN estudiante
  ON estudiante.id = permiso.estudiante".($id?" where permiso.id='$id'":'');
break;
case 'POST':
$estudiante = $_POST['estudiante'];
$nivel = $_POST['nivel'];
$motivo = $_POST['motivo'];
//$autoriza = $_POST['autoriza'];
$fecha = $_POST['fecha'];
$sql = "insert into permiso(estudiante,grado,motivo,autoriza,fecha) values ('$estudiante','$nivel','$motivo','1063300726','$fecha')";
//echo $sql;
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
        'creado'=>$row[0],
          'estudiante'=>$row[1],
          'grado'=>$row[2],
          'motivo'=>$row[3],
          'fecha'=>$row[4],
          'id'=>$row[5]

      );
      //echo $row[0];
    }
    $jsons=json_encode($json);
    echo $jsons;
}
?>