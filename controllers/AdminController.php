<?php

namespace Controllers;
use MVC\Router;
class AdminController{

    public static function index(Router $router){
        $alertas = [];
        
        session_start();
        if(empty($_SESSION)) header("Location: /");
       
            $router->render('admin/index',[
                "alertas" => $alertas,
                "nombre" => $_SESSION["nombre"]
            ]);  
    }
}