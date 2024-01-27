<?php
if(isset($alertas)){
foreach ($alertas as $key => $mensajes) { //ALERTAS AL SER UN ARREGLO DOBLE, NECESITAMOS RECORRERLO CON 2 FOR
    foreach ($mensajes as $mensaje) {
?>
        <div class="alerta <?php echo $key?>" >
            <?php echo $mensaje ?>
        </div>

<?php
    }
}
}
?>