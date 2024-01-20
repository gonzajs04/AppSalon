<div class="barra">
<p>Hola! <span> <?php echo $nombre?></span></p>

</div>

<div class="container-titulo">
    <h1 class="nombre-pagina">Crear nueva cita</h1>
    <p class="descripcion-pagina movi">Elige tus servicios a continuacion</p>
</div>



<div class="app">
    <nav class="tabs">
        <button type="button" class="actual " data-paso="1">Servicios</button>
        <button type="button"  data-paso="2" >Informacion Cita</button>
        <button type="button"  data-paso="3">Resumen</button>

    </nav>

    <div id="paso-1" class="seccion mostrar">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>

        <form action="" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" value="<?php echo isset($nombre) ? $nombre : '';?>" disabled>
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" min="<?php echo date('Y-m-d',strtotime('+1 day'));?>">
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora">
            </div>

            <input type="hidden" id="id" value=<?php echo isset($id);?>>

        </form>

    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la info sea correcta</p>
    </div>


    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton"> Siguiente &raquo;</button>
    </div>



</div>
<!--DEFINO SOLO ESTA VARIABLE PARA SOLO ESTE ARCHIVO-->
<?php $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    <script src='build/js/app.js'></script>
";

?>