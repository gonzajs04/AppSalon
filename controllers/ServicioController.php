<?php
namespace Controllers;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        $alertas = [];
        session_start();


        $router ->render("/servicios/index",[
            "alertas"=>$alertas,
            "nombre"=> $_SESSION['nombre']
        ]);
    }
    public static function crear(Router $router){
        session_start();
        //En caso de que la vista realice un POST entra al IF, de lo contrario hace tarea del GET
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            return;
        }

        $router->render("/servicios/crear",[
            "nombre"=> $_SESSION['nombre']
        ]);
        
    }
    public static function actualizar(Router $router){
        session_start();
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            return;
        }

        $router->render("/servicios/actualizar",[
            "nombre"=> $_SESSION['nombre']
        ]);
    }
    public static function eliminar(){

    }
}