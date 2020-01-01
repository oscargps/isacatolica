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
    $tab = $_GET['tab'];
    $sql = "SELECT max(id) FROM $tab";
    $result = mysqli_query($conn,$sql);

    if (!$result) {
        die('Could not query:' . mysqli_error());
    }
    
   $row = mysqli_fetch_array($result);
   echo $row[0];
}
  ?>