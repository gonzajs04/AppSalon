<?php 

namespace Controllers;
use MVC\Router;
use Model\Servicio;
use Model\Cita;
class ApiController{
    public static function index(){
        $servicios = Servicio::all(); //obtengo la lista de servicios de la base de datos
        echo json_encode($servicios); //convierte objeto o array en un JSON

    }        

    public static function guardar(){
        $cita = new Cita($_POST); //Instancio el modelo de Cita y le paso los datos del form.
        $resultado = $cita->guardar(); //Lo guardo en la base de datos
    
        echo json_encode($resultado); //envio el resultado
    }
}



