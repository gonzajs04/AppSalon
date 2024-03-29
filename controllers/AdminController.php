<?php

namespace Controllers;
use Model\AdminCita;
use MVC\Router;

class AdminController
{

    public static function index(Router $router)
    {
        $alertas = [];
        //Defino una variable $fecha con el dia de hoy en el formato de SQL Y-m-d. Le resto 1 dia porque me da 25 en vez de 24
        
        session_start();
        isAdmin(); // Protejo la URL /admin

        //Obtengo la fecha desde la URL y si no existe le asigno la del dia actual
        $fecha = $_GET['fecha'] ?? date('Y-m-d',strtotime("-1 day"));
        $fecha = explode('-',$fecha);
        //Checkea si es posible la fecha que esta en la URL, por ejemplo, es imposible una fecha como la siguiente: 2024-35-70. Esta funcion checkdate nos devuelve un T o F
        if(!checkdate($fecha[1],$fecha[2],$fecha[0])) header('Location: /admin');
        //Consultar la base de datos.

        //Uno nuevamente el array con el año,mes y dia y lo separo por -
        $fecha = implode('-',$fecha);

        $consulta =  "SELECT Citas.id, CONCAT(Usuarios.nombre,' ', Usuarios.apellido) as 'cliente', Usuarios.telefono as 'telefono',";
        $consulta .= "Usuarios.email, Servicios.nombre as 'servicio', Servicios.precio, Citas.hora as 'hora' ";
        $consulta .= "FROM Citas ";
        $consulta .= "LEFT OUTER JOIN Usuarios ";
        $consulta .= "ON Citas.idUsuario =  Usuarios.id ";
        $consulta .= "LEFT OUTER JOIN Citas_Servicios ";
        $consulta .= "ON Citas.id =Citas_Servicios.idCita ";
        $consulta .= "LEFT OUTER JOIN Servicios ";
        $consulta .= "ON Servicios.id = Citas_Servicios.idServicio ";
        $consulta .= "WHERE Citas.fecha = '" . $fecha . "';";
        $citas = AdminCita::SQL($consulta);
        $router->render('admin/index', [
            "alertas" => $alertas,
            "nombre" => $_SESSION["nombre"],
            "fecha"=>$fecha,
            "citas" => $citas
        ]);
    }
}
