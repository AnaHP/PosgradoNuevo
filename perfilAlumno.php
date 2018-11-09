<?php
    $page_title = 'Sistema Posgrado';
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


include('connectmysql.php');

      if($_SERVER['REQUEST_METHOD']=='POST'){

          $errores=array();
          if (empty($_POST['full-name']) || empty($_POST['telefono']) || empty($_POST['direccion']) ){
              $errores="Te faltan datos por llenar";

          }
          else{
          $expediente = $_SESSION['user'];

          $nombreAlumno = trim($_POST['nombreAlumno']);

          $aPaterno = trim($_POST['aPaterno']);

          $aMaterno = trim($_POST['aMaterno']);

          }

      if (empty($errores)) {
          $query= "UPDATE alumno SET nombreAlumno = '$nombreAlumno', aPaterno= '$aPaterno', aMaterno= '$aMaterno'
          WHERE expediente = '$expediente'";
          $resultado=@mysqli_query($dbcon,$query);
          if($resultado){
              echo '<script>alert("Gracias por modificar")</script>';
          }
          else{

              echo '<script>alert("Hubo error, intenta mas tarde")</script>';
          }

        }
          else{
              echo '<script>alert("El servidor esta en mantenimiento, intenta mas tarde")</script>';
          }
      }
?>
<div class = "descripcion">

  <div id="des">
     <h2>BIENVENIDO <?php if(isset($_SESSION['user'])){echo $_SESSION['user'];} ?></h2>
     <!--<input type="text" name="des" value="Inscribite a nuestras convocatorias">-->
  </div>
  <div class="contenido-all">



              <div class="form-add-user">
               <p style="color: #3458C1; text-align: center; margin-left:10px; font-size: 24px;
               ">Edita los campos</p>
               <form method="post" action="perfilAlumno.php">

               <p style="margin-top: 15px; margin-left: 15px;
               color: #3458C1; font-size: 14px;">Nombre</p>
               <input type="text" placeholder="Nombre Completo" class="input-grp size" name="nombreAlumno" style="display: inline-block;"
               maxlength="50" required autofocus pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Sólo letras">
               
               <p style="margin-top: 15px; margin-left: 15px;
               color: #3458C1; font-size: 14px;">Apellido Paterno</p>
               <input type="text" placeholder="Apellido Paterno" class="input-grp size" name="aPaterno" style="display: inline-block;"
               maxlength="50" required autofocus pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Sólo letras">
               
               <p style="margin-top: 15px; margin-left: 15px;
               color: #3458C1; font-size: 14px;">Apellido Materno</p>
               <input type="text" placeholder="Apellido Materno" class="input-grp size" name="aMaterno" style="display: inline-block;"
               maxlength="50" required autofocus pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Sólo letras">

                 <br>
               <button style="padding: 10px;
               margin-left: 25px; margin-top: 25px; background: #3458C1; color:#fff;" name="edit_account" type="submit">
                 Editar
               </button>
             </form>
         </div>

  </div>

</div><!--descripcion-->

<?php
}
?>
<?php include_once('footer.php'); ?>
