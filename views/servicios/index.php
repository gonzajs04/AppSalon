<section class="contenedor">


<?php include_once __DIR__ . "../../templates/barraservicios.php"; ?>


<?php include_once __DIR__ . "../../templates/barraperfil.php";?>
<h1 class="nombre-pagina">Servicios</h1>
<p class='descripcion-pagina'>Administrador de servicios</p>

<ul class="servicios">

    <?php foreach ($servicios as $servicio) {?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre;?></span></p>
            <p>Precio: <span><?php echo '$'. $servicio->precio;?></span></p>
            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Modificar</a>
                <form action="/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <input type="submit" value="Borrar" class="boton-eliminar">

                </form>
            </div>
        </li>

        <?php }?>

</ul>
</section>
