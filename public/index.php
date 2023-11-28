<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();
                //LLAMA A LA CLASE CONTROLADOR   //LLAMA AL METODO LOGIN
$router->get('/',[LoginController::class, 'login']);
$router->post('/',[LoginController::class,"login"]);
$router->get('/logout',[LoginController::class,"logout"]);

//RECUPERAR PASSWORD
$router->get('/olvide',[LoginController::class,'olvide']);
$router->post('/olvide',[LoginController::class,'olvide']);

//OTRA RUTA PARA RECUPERAR LA CONTRASEÑA
$router->get('/recuperar',[LoginController::class,'recuperar']);
$router->post('/recuperar',[LoginController::class,'recuperar']);


//CREAR CUENTA

$router->get("/crear-cuenta",[LoginController::class,'crear']);
$router->post("/crear-cuenta",[LoginController::class,'crear']);

//CONFIRMAR CUENTA
$router->get("/confirmar-cuenta",[LoginController::class, 'confirmar']);
$router->get("/mensaje",[LoginController::class, 'mensaje']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();