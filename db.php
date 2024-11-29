<?php
session_start();

//coneccion a base u guardado en variable
$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'user_auth'
);
/*if(isset($conn)){
  echo 'Base de datos conectada';
}*/

?>
