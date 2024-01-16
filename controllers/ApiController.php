<?php 

namespace Controllers;
use MVC\Router;
use Model\Servicio;
class ApiController{
    public static function index(Router $router){
        $servicios = Servicio::all(); //obtengo la lista de servicios de la base de datos
        echo json_encode($servicios); //convierte objeto o array en un JSON

    }        
}



