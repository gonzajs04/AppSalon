<?php
namespace Model;
use Model\ActiveRecord;

class Servicio extends ActiveRecord{

    protected static $tabla = "Servicios"; //tabla a consultar en la base de datos.
    protected static $columnasDB = ["id","nombre","precio"]; //columnas de la bse de datos
    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->precio = $args["precio"] ?? '';
        $this->nombre = $args['nombre'] ?? 'nombre';
    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        
        if(!$this->precio)self::$alertas['error'][] = 'El precio es obligatorio';

        //Verifico si es un numero el precio
        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = 'El Precio no es valido';
        }

        return self::$alertas;
    }

}
