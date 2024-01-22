<?php include_once __DIR__ . '../../templates/barraperfil.php';?>

<section class="contenedor">
    <h1 class="nombre-pagina">Panel de administracion</h1>
    <h2>Buscar citas</h2>
    <div class="busqueda">
        <form class="formulario" action="">
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha">
            </div>
        </form>
    </div>

    <div id="citas-admin">
        <ul class="citas" >
        <?php foreach($citas as $cita){
            if(isset($idCita) != $cita->id){
                $idCita = $cita->id;
        ?>
             <li>
            <p>ID: <span><?php echo $cita->id ?></span></p>
             <p>Hora: <span><?php echo $cita->hora ?></span></p>
            <p>Cliente: <span><?php echo $cita->cliente ?></span></p>
            <p>Telefono: <span><?php echo $cita->telefono ?></span></p>
            <p>Email: <span><?php echo $cita->email ?></span></p>
            <h3>Servicios</h3>
        <?php  } //FIN DE IF ?>
            <p class="servicio"><span><?php echo $cita->servicio ." $" .$cita->precio ?></span></p>
         
      
        <?php } //FIN FOR EACH ?>
        </li>
        </ul>
    </div>
</section>