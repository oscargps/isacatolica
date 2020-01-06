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
      $sql = "select * from estudiante".($id?" where id='$id'":'');
      break;
    case 'POST':
    $mode = $_POST['mode'];
      $id = $_POST["id"];
      $name= $_POST["name"];
      $contacto= $_POST["phone"];
      $nivel = $_POST['nivel'];
      $acu = $_POST["acu"];
      $dir = $_POST['dir'];
      if ($mode=="add") {
        $sql = "insert into estudiante (id, nombre, nivel, telefono, acudiente, director) values ('$id', '$name', '$nivel', '$contacto', '$acu','$dir')";
      }elseif($mode=="put"){
        $sql = "update estudiante set nombre= '$name', telefono='$contacto', acudiente='$acu', nivel='$nivel', director = '$dir' where id= '$id' ";
      }else{
        echo $sql;
        $id=$_POST['id'];
        $sql = "DELETE  from estudiante  where id='$id'";
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
          'name'=>$row[1],
          'nivel'=>$row[2],
          'tel'=>$row[3],
          'acu'=>$row[5]

      );
      //echo $row[0];
    }
    $jsons=json_encode($json);
    echo $jsons;
}
 ?>
