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
        isAdmin();
        $alertas = [];
        //is_numeric evalua si es un numero o no. Retorna T o F
        if(!is_numeric($_GET['id'])) return;

        $servicio = Servicio::find($_GET['id']);
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //Sincronizo el objeto para que me muestre en los campos los valores de POST
            $servicio ->sincronizar($_POST);
            //Valido, con el modelo de Servicio, si estan los valores de nombre y precio llenos.
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header("Location: /servicios");
            }
        }

        $router->render("/servicios/actualizar",[
            "nombre"=> $_SESSION['nombre'],
            "alertas"=> $alertas,
            "servicios"=> $servicio
        ]);
    }
    public static function eliminar(){
        session_start();
        isAdmin();
        if(!is_numeric($_POST['id'])) return;

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $servicio = Servicio::find($_POST['id']);
            $servicio->eliminar();
            header('Location: /servicios');
        }
    }
}