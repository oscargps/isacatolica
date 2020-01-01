<?php
include('conexion.php');
error_reporting(E_ALL ^ E_NOTICE);
$conn = mysqli_connect($host,$user,$pw) or die("Error en la conexion al servidor");
mysqli_select_db($conn,$db);
if (!$conn) {
  echo "Ocurrió un error.\n";
  exit;
}
//$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
switch ($method) {
    case 'GET':
      $id=$_GET['id'];
      $sql = "select * from docentes".($id?" where id='$id'":'');
      break;
    case 'POST':
    $mode = $_POST['mode'];
      $id = $_POST["id"];
      $nombre= $_POST["nombre"];
      $cargo  = $_POST['cargo']
;      $contacto= $_POST["phone"];
      $correo = $_POST["correo"];
      if ($mode=="add") {
        $sql = "insert into docentes (id, nombre, cargo, telefono, correo) values ('$id', '$nombre', 'cargo', '$contacto', '$correo')";
      }elseif($mode=="put"){
        $sql = "update docentes set nombre= '$nombre',cargo = '$cargo', telefono='$contacto', correo='$correo' where id= '$id' ";
      }else{
        $id=$_POST['id'];
        $sql = "DELETE  from docentes  where id='$id'";

      }
      break;

}
//echo $sql;
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
        'id'=>$row[0],
          'nombre'=>$row[1],
          'cargo'=>$row[2],
          'correo'=>$row[3],
          'phone'=>$row[4]
      );
      //echo $row[0];
    }
    $jsons=json_encode($json);
    echo $jsons;
}
 ?>
