<?php
namespace Controllers;
use MVC\Router;
use Model\Servicio;

class ServicioController{
    public static function index(Router $router){
        $alertas = [];
        session_start();
        isAdmin();
        $servicios = Servicio::all();

        $router ->render("/servicios/index",[
            "alertas"=>$alertas,
            "nombre"=> $_SESSION['nombre'],
             'servicios' => $servicios
        ]);
    }
    public static function crear(Router $router){
        session_start();
        $servicios = new Servicio;
        $alertas = [];

        //En caso de que la vista realice un POST entra al IF, de lo contrario hace tarea del GET
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //Sincroniza el NUEVO objeto con el POST
            $servicios->sincronizar($_POST);

            $alertas = $servicios->validar();
            if(empty($alertas)){
                $servicios->guardar();
                header("Location: /servicios");
            }
        }

        $router->render("/servicios/crear",[
            "nombre"=> $_SESSION['nombre'],
            "servicios"=> $servicios,
            "alertas"=> $alertas
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