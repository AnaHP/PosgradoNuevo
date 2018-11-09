<?php
    $page_title = 'Documentos';
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
if($_SERVER['REQUEST_METHOD']=='POST'){
include('connectmysql.php');

$errores=array();
}
?>
<!--CONTENIDO DE TODO-->
<div class = "descripcion">
	<div class="contenido-all">
    <div class="espacio_contenido">
        <h3 class="titulos">Documentos</h3>
        <div class="tabla-contenedor">
          <table class="tabla-general">
                <thead>

                <tr>
                  <th style="background:#30ACAC; color:white;">ID </th>
                  <th style="background:#30ACAC; color:white;">CURP</th>
                  <th style="background:#30ACAC; color:white;">Recibo de Pago</th>
                  <th style="background:#30ACAC; color:white;">Cédula de Inscripcion</th>

                </tr>
              </thead>
              <tbody>
                <?php
                      require('connectmysql.php');

                      $docs="SELECT alumno, CURP, recibo_pago, cedula_inscripcion FROM ARCHIVOS";
                      $sqldata= mysqli_query($dbcon,$docs) or die('errorrr');


                      while($row=mysqli_fetch_array($sqldata,MYSQLI_ASSOC)){
                          echo "<tr><td>";
                          echo $row['alumno'];
                          echo "</td><td>";
                          //echo $row['CURP'];
                          $ruta_curp=$row['CURP'];echo '<img src="'.$ruta_curp.'" width="50px" height="100px"><br>';
                          echo "</td><td>";
                          //echo $row['recibo_pago'];
                          $ruta_recibo=$row['recibo_pago'];echo '<img src="'.$ruta_recibo.'" width="50px" height="100px"><br>';
                          echo "</td><td>";
                          //echo $row['cedula_inscripcion'];
                          $ruta_cedula=$row['cedula_inscripcion'];echo '<img src="'.$ruta_cedula.'" width="50px" height="100px"><br>';
                          echo "</td>";
                          //echo '<option value="'.$valores[id_municipio].'">'.$valores[nombre_municipio].'</option>';

                          if (empty($row))
                              echo '<p>No hay ningún alumno registrado</p><p><br/></p>';
                      }

                      ?>
              </tbody>
          </table>

        </div>

    </div>

  </div>
</div>
<?php
}
?>
<?php include_once('footer.php'); ?>
