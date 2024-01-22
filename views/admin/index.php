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
            <li><p>ID: <span><?php echo $cita->id ?></span></p></li>
            <li><p>Hora: <span><?php echo $cita->hora ?></span></p></li>
            <li><p>Cliente: <span><?php echo $cita->cliente ?></span></p></li>
            <li><p>Telefono: <span><?php echo $cita->telefono ?></span></p></li>
            <li><p>Email: <span><?php echo $cita->email ?></span></p></li>
        <?php  } //FIN DE IF ?>
            <li><p>Servicio: <span><?php echo $cita->servicio ?></span></p></li>
            <li><p>Precio: <span><?php echo $cita->precio ?></span></p></li>
        <?php } //FIN FOR EACH ?>
        </ul>
    </div>
</section>