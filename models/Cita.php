<?php
namespace Model;
use Model\ActiveRecord;
class Cita extends ActiveRecord{

    protected static $tabla = "Citas";
    protected static $columnasDB = ['id','idUsuario','fecha','hora'];
    public $id;
    public $fecha;
    public $hora;
    public $idUsuario;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->idUsuario = $args['idUsuario'] ?? '';
    }

}