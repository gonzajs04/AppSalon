<?php 

namespace Controllers;
use Model\CitaServicios;
use Model\Servicio;
use Model\Cita;
class ApiController{
    public static function index(){
        $servicios = Servicio::all(); //obtengo la lista de servicios de la base de datos
        echo json_encode($servicios); //convierte objeto o array en un JSON

    }        

    public static function guardar(){
        //Almacena la cita y devuelve el ID
        $cita = new Cita($_POST); //Instancio el modelo de Cita y le paso los datos del form.
        $resultado = $cita->guardar(); //Lo guardo en la base de datos
        $idCita = $resultado['id']; //extraigo la id de la cita

        //Almacena las citas y el servicios
        $idServicios = explode(',',$_POST['servicios']); // me devuelve un arreglo con los datos separados

        foreach($idServicios as $idServicio){
            $args = [
                'idCita' =>$idCita,
                'idServicio'=>$idServicio
            ];
            $citaServicios = new CitaServicios($args);
            $res2 = $citaServicios->guardar(); //Guardo en la tabla citas_servicios de la bd
        }
        $respuesta = [
            "resultado"=>$res2, 
        ];
        echo json_encode($respuesta); //envio el resultado
    }
}



