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

?>
				<div class = "descripcion">

					<div id="des">
						 <h2>BIENVENIDO <?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?></h2>
						 <!--<input type="text" name="des" value="Inscribite a nuestras convocatorias">-->
					</div>

				</div><!--descripcion-->
<?php include_once('footer.php'); ?>
