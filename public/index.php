<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\AdminController;
use MVC\Router;
use Controllers\CitaController;
use Controllers\ApiController;
use Controllers\ServicioController;
$router = new Router();
                //LLAMA A LA CLASE CONTROLADOR   //LLAMA AL METODO LOGIN
$router->get('/',[LoginController::class, 'login']);
$router->post('/',[LoginController::class,"login"]);
$router->get('/logout',[LoginController::class,"logout"]);

//PESTAÑA OLVIDE PASSWORD
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


//Endpoints Citas
$router->get("/cita",[CitaController::class,'index']);

//API DE CITAS
$router->get("/api/servicios",[ApiController::class,'index']);

$router->post("/api/citas",[ApiController::class,"guardar"]);
//Eliminar citas: HTTP no soporta delete y tampoco PHP
$router->post("/api/eliminar", [ApiController::class,"delete"]);


//ADMIN
$router->get("/admin",[AdminController::class,"index"]);


//CRUD DE SERVICIOS
$router->get("/servicios",[ServicioController::class,"index"]);
$router->get("/servicios/crear",[ServicioController::class,"crear"]);
$router->post("/servicios/crear",[ServicioController::class,"crear"]);
$router->get("/servicios/actualizar",[ServicioController::class,"actualizar"]);
$router->post("/servicios/actualizar",[ServicioController::class,"actualizar"]);
$router->post("/servicios/eliminar",[ServicioController::class,"eliminar"]);




// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();