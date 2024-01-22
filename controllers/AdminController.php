<?php

namespace Controllers;
use Model\AdminCita;
use MVC\Router;

class AdminController
{

    public static function index(Router $router)
    {
        $alertas = [];
        session_start();
        if (empty($_SESSION)) header("Location: /");

        //Consultar la base de datos.

        $consulta =  "SELECT citas.id, CONCAT(usuarios.nombre,' ', usuarios.apellido) as 'cliente', usuarios.telefono as 'telefono',";
        $consulta .= "usuarios.email, servicios.nombre as 'servicio', servicios.precio, citas.hora as 'hora' ";
        $consulta .= "FROM CITAS ";
        $consulta .= "LEFT OUTER JOIN usuarios ";
        $consulta .= "ON citas.idUsuario =  usuarios.id ";
        $consulta .= "LEFT OUTER JOIN citas_servicios ";
        $consulta .= "ON citas.id =citas_servicios.idCita ";
        $consulta .= "LEFT OUTER JOIN servicios ";
        $consulta .= "ON servicios.id = citas_servicios.idServicio; ";
        //$consulta .= "WHERE citas.fecha = " . ${fecha} . ";";
        $citas = AdminCita::SQL($consulta);

        $router->render('admin/index', [
            "alertas" => $alertas,
            "nombre" => $_SESSION["nombre"],
            "citas" => $citas
        ]);
    }
   
}
