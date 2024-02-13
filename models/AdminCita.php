<?php
namespace Model;
use Model\ActiveRecord;
class AdminCita extends ActiveRecord{
    protected static $tabla = "Citas_Servicios";
    protected static $columnasDB = ["id","cliente","telefono","email","servicio","precio","hora"];
    public $id;
    public $cliente;
    public $telefono;
    public $email;
    public $servicio;
    public $precio;
    public $hora;
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->cliente = $args['cliente'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->hora = $args['hora'] ?? '';
    }

}