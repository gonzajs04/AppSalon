<?php
namespace Model;
use Model\ActiveRecord;

namespace Model;
use Model\ActiveRecord;
class CitaServicios extends ActiveRecord{

    protected static $tabla = 'citas_servicios';
    protected static $columnasDB = ['id','idCita','idServicio'];
    public $idCitaServicio;
    public $idCita;
    public $idServicio;

    public function __construct($args = []){
        $this->idCitaServicio = $args['id'] ?? null;
        $this->idCita = $args['idCita'] ?? '';
        $this->idServicio = $args['idServicio'] ?? '';
    }


}