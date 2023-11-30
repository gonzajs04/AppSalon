<?php include_once __DIR__ . '/../templates/alertas.php';?>
<h1 class="nombre-pagina">Restablecer contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña escribiendo tu email</p>

<form action="/olvide" class="formulario" method="post">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu E-mail">
    </div>

    <input type="submit" value="Enviar instrucciones" class="boton">
</form>


<div class="acciones">
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
    <a href="/">Ya te acordaste tus datos? Vuelve a iniciar sesion</a>
</div>