
<div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre del servicio" value="<?php echo $servicios->nombre ?? 'Coloca un nombre'?>">

   
</div>

<div class="campo">
    <label for="precio" class="precio">Precio</label>
    <input type="number" name="precio" id="precio" placeholder="Precio del servicio" value="<?php echo $servicios->precio ?? ''?>">

</div>
<?php

//COMPARTE EL FORM EN BASTANTES COSAS TANTO CREAR COMO ACTUALIZAR