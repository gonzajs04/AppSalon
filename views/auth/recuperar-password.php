
<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuacion</p>
<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<?php if(!$error){?>
<form method="POST" class="formulario">

    <div class="campo">
        <label for="pass">Contraseña</label>
        <input type="password" name="pass" id="pass" placeholder="Tu nueva contraseña">
    </div>
    <input type="submit" value="Guardar nueva contraseña" class="boton">

</form>
<?php }?>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Iniciar Sesion</a>
    <a href="/crear-cuenta">¿No tienes cuenta? Crear Una</a>
</div>
