<?php

  DEFINE ('DB_USER','root');
  DEFINE ('DB_PSWD', '');
  DEFINE ('DB_HOST', 'localhost');
  DEFINE ('DB_NAME', 'posgradonuevo');

  $dbcon = mysqli_connect(DB_HOST,DB_USER,DB_PSWD, DB_NAME);

  if(!$dbcon){
    die('error al conectar en la base de datos');
  }else{///SOLO PARA COMPROBAR
    //echo "Conectado";
  }


 ?>
