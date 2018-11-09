<?php
    $page_title = 'Envio de Documentos';
    include ('header.php');
 session_start();
  if (@$_SESSION['id'] == 'Coordinador'){
    include("coordinador.php");
  }
  elseif (@$_SESSION['id']=='Alumno'){
    include("alumno.php");
  }
  elseif (@!$_SESSION['id']) {
    include("menu_principal.php");
  }

  if(!isset($_SESSION["user"])) {
  header("location:login.php");
  } else {
?>
<?php
require('connectmysql.php');
  $valor_id="";
    $expediente=$_SESSION['user'];
    $query = "select * from alumno where expediente like '$expediente' ";
    $sql_datos=mysqli_query($dbcon,$query) or die('Error');
    while ($valores = mysqli_fetch_array($sql_datos)){
        $valor_id=$valores['id_alumno'];
        $valor_expediente=$valores['expediente'];
        $valor_nombre=$valores['nombreAlumno'];
        $valor_aPaterno=$valores['aPaterno'];
        $valor_aMaterno=$valores['aMaterno'];
        $valor_plan=$valores['idPlan'];
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // $consulta="SELECT id_alumno from alumno where ";

$id_alumno = trim($_POST['id_alumno']);

$rutaEnServidor='documentos/';

$rutaTemporal1=$_FILES['cedula_inscripcion']['tmp_name'];
$nombreImagen1=$_FILES['cedula_inscripcion']['name'];
$rutaCedula=$rutaEnServidor.$nombreImagen1;

move_uploaded_file($rutaTemporal1,$rutaCedula);

$rutaTemporal2=$_FILES['recibo_pago']['tmp_name'];
$nombreImagen2=$_FILES['recibo_pago']['name'];
$rutaRecibo=$rutaEnServidor.$nombreImagen2;

move_uploaded_file($rutaTemporal2,$rutaRecibo);

$rutaTemporal3=$_FILES['curp']['tmp_name'];
$nombreImagen3=$_FILES['curp']['name'];
$rutaCURP=$rutaEnServidor.$nombreImagen3;

move_uploaded_file($rutaTemporal3,$rutaCURP);

$insert="INSERT INTO ARCHIVOS values('$expediente','$rutaCURP','$rutaRecibo', '$rutaCedula')";
$resultado=@mysqli_query($dbcon,$insert);

//Si la consulta tuvo éxito, entonces imprimir un mensaje
if($resultado){
        echo '<script>alert("Gracias por tu registro")</script>';
    }
    else{
        echo '<script>alert("El servidor esta en mantenimiento, intenta mas tarde")</script>';
    }

// Cerrar la conexión a la base de datos
mysqli_close($dbcon);
}
?>

<!--CONTENIDO DE TODO-->
<div class = "descripcion">
          <div id="des">
	   <h2>Envio de Documentos</h2>
	   <!--<input type="text" name="des" value="Inscribite a nuestras convocatorias">-->
          </div>
	<div class="contenido-all">
    <form enctype="multipart/form-data" action="envdoc.php" method="POST">
                    <div class="espacio_contenido">
                              <h3 class="titulos">REGISTRO</h3>
                              <br>
                              <label class="parr-title" for="usuario_alumno">Tu usuario es:</label>
                              <input class="inputs-profe" type="text" name="usuario_alumno" disabled id="usuario_alumno" value="<?php echo($valor_expediente);?>">
                              <br><br>
                              <label class="parr-title" for="folio_alumno">Tu folio/contraseña es:</label>
                              <input class="inputs-profe" type="text" name="folio_alumno" disabled id="folio_alumno" value="<?php echo($valor_expediente);?>">
                              <br><br>
                              <input class="inputs-profe" type="text" name="id_alumno"  id="id_alumno" value="<?php echo($valor_expediente);?>" style="visibility: hidden;">
                              <br><br>
                              <label class="parr-title" for="cedula_inscripcion">Cédula de inscripción:</label>
                              <input class="inputs-profe" type="file" name="cedula_inscripcion" required >
                              <br><br>
                              <label class="parr-title" for="recibo_pago">Recibo de pago:</label>
                              <input class="inputs-profe" type="file" name="recibo_pago" required>
                              <br><br>
                              <label class="parr-title" for="curp_alumno">CURP:</label>
                              <input class="inputs-profe" type="file" name="curp" required>
                              <br><br>
                              <input type="submit" value="Enviar" class="btn-enviar-form" name="guardar">
                    </div>
      </form>

  </div>
</div>
<?php
}
?>
<?php include_once('footer.php'); ?>
