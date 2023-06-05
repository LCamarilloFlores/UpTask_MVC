<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','email','password','token','confirmado'];
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $token;
    public $confirmado;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '';
    }

    //Validación para cuentas nuevas
    public function validarNuevaCuenta($password2){
        if(!$this->nombre)
        self::$alertas['error'][] ="El nombre no puede estar vacio";
        if(!$this->email)
        self::$alertas['error'][] ="El email no puede estar vacio";
        if(!$this->password)
        self::$alertas['error'][] ="El password no puede estar vacio";
        else if($this->password!==$password2)
        self::$alertas['error'][] ="Los password no concuerdan";
        return self::$alertas;
    }
}