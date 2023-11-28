<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesion con tus datos</p>
<?php include_once __DIR__ . '/../templates/alertas.php';?>

<form class="formulario" action="/" method="post">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"
          placeholder="Tu Email"
          aria-label="Email"
          value="<?php echo s($auth->email)?>"
        >
    </div>
    <div class="campo">
        <label for="pass">Contraseña</label>
        <input type="password" name="pass" id="pass" placeholder="Tu password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion">

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
    <a href="/olvide">Olvide mi contraseña</a>
</div>