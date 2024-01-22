<?php

namespace Controllers;
use MVC\Router;
class AdminController{

    public static function index(Router $router){
        $alertas = [];

        $router->render('admin/index',[
            "alertas" => $alertas,
        ]);
    }
}