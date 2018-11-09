<?php
    $page_title = 'Login';
    include ('header.php');

  if (@$_SESSION['id'] == 'Coordinador'){
    header("Location:inicio.php");
  }
  elseif (@$_SESSION['id']=='Alumno'){
    header("Location:inicio.php");
  }
  elseif (@!$_SESSION['id']) {
    include("menu_principal.php");
  }

?>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require ("connectmysql.php");
    $errores = array();

    if(empty($_POST['text']) or empty($_POST['password'])){
      $errores[] = 'Error' ;
    }
    else{
      $username = trim($_POST['text']);
      $pass = trim($_POST['password']);
    }

    if(empty($errores)){
      session_start();

      $query = "select * from usuario where password_usuario like '$pass' and expediente like '$username'";
      $resultado = mysqli_query($dbcon, $query);
      $n = mysqli_num_rows($resultado); //Si hay algo incorrecto debe ser 0
      if($n==0) {
        echo '<script>alert("Sus datos estan incorrectos, verifique")</script>';
        echo "<script>location.href='index.php'</script>";
      }
      else{// si todo está correcto entonces n!=0 y ya no hay pez xd
        if($resultado){
        while ($user = mysqli_fetch_assoc($resultado)){
          if ($pass == $user['password_usuario'] && $username == $user['expediente'] && 'Coordinador' == $user['tipo_Usuario']){

            $_SESSION['id']=$user['tipo_Usuario'];
            $_SESSION['user']=$user['expediente'];
            echo '<script>alert("BIENVENIDO COORDINADOR")</script>';
            echo "<script>location.href='inicio.php'</script>";
          }
          elseif ($pass == $user['password_usuario'] && $username == $user['expediente'] && 'Alumno' == $user['tipo_Usuario']){
            $_SESSION['id']=$user['tipo_Usuario'];
            $_SESSION['user']=$user['expediente'];
            $_SESSION['name']=$user['nombreAlumno'];
            echo '<script>alert("BIENVENIDO ALUMNO")</script>';
            echo "<script>location.href='inicio.php'</script>";
          }
        }
      }
    }

  }
  else{
    echo '<script>alert("Error, sus datos estan incompletos, no entro")</script>';
    echo "<script>location.href='index.php'</script>";
  }
  // Cerrar la conexión a la base de datos
  mysqli_close($dbcon);

  }
?>