<?php

namespace Controllers;
use MVC\Router;

class CitaController{


    public static function index( Router $router){
        session_start();
        if(!empty($_SESSION['nombre'])){

     
        $router->render('cita/index',[
            "nombre" => $_SESSION['nombre']

        ]);
    }
    else{
        header('Location: /');
    }
    }
}


?>