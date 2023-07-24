<?php

namespace Model;

use Model\ActiveRecord;

class Proyecto extends ActiveRecord
{
    protected static $tabla = 'proyectos';
    protected static $columnasDB = ['id', 'proyecto', 'url', 'propietarioId'];
    public $id = null;
    public $proyecto = '';
    public $url = '';
    public $propietarioId = '';
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->proyecto = $args['proyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';
    }

    public function validarProyecto()
    {
        if (!$this->proyecto)
            self::$alertas["error"][] = "El nombre del proyecto es requerido";

        return self::$alertas;
    }

    public function obtenerUrl()
    {
        $this->url = md5(uniqid());
        return;
    }

    public static function belongsTo($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}
