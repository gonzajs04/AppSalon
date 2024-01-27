<?php include_once __DIR__ . "../../templates/barraservicios.php"; ?>

<?php include_once __DIR__ . "../../templates/barraperfil.php"; ?>

<h1 class="nombre-pagina">Actualizar servicios</h1>

<form action="servicios/actualizar" method="post" class="formulario">
<?php include_once __DIR__ . "./formulario.php"; ?>

<input type="submit" value="Actualizar servicio" class="boton">
</form>