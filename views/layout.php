<!DOCTYPE html>
    <!--LAYOUT SIRVE COMO PAGINA MAESTA. ES COMO UN APP.JSX EN REACT, CONTIENE LA BASE DE LA PAGINA-->

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="App salon te permite sacar turnos de tu peluqueria en cualquier momento del dia.">
    <title>App Salón</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css"> <!--PONGO ESTA DIRECCION YA QUE DEBEMOS TOMAR COMO PIE EL INDEX.PHP, NO LAYOUT
-->
</head>
<body>
    <div class="contenedor-app">
        <div class="imagen">
            
        </div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>

    <?php echo $script ?? '';?>
            
</body>
</html>