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
  $sql="SELECT estudiante.nombre,citacion.grado,citacion.acudiente,citacion.fecha,TIME_FORMAT(citacion.fecha,'%r'),creado,motivo,citacion.id
  FROM citacion
  INNER JOIN estudiante
  ON estudiante.id = citacion.estudiante".($id?" where citacion.id='$id'":'');
break;
case 'POST':
$estudiante = $_POST['estudiante'];
$grado = $_POST['nivel'];
$acudiente = $_POST['acudiente'];
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$sql = "insert into citacion(estudiante,grado,acudiente,fecha,motivo,docente) values ('$estudiante','$grado','$acudiente','$fecha','$motivo','1063300726')";

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
    $fechato = explode(' ',$row[3]);
      $json[]=array(
        'estudiante'=>$row[0],
          'grado'=>$row[1],
          'acudiente'=>$row[2],
          'fecha'=>$fechato[0],
          'hora'=>$row[4],
          'creado' =>$row[5],
          'motivo' =>$row[6],
          'id' =>$row[7]

      );
      //echo $row[0];
    }
    $jsons=json_encode($json);
    echo $jsons;
}
?>