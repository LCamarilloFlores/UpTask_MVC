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
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //Validación para cuentas nuevas
    public function validarNuevaCuenta($password2){
        if(!$this->nombre)
        self::$alertas['error'][] ="El nombre no puede estar vacio";
        if(!$this->email)
        self::$alertas['error'][] ="El email no puede estar vacio";
        if(!$this->password)
        self::$alertas['error'][] ="El password no puede estar vacio";
        else if(strlen($this->password)<6)
        self::$alertas['error'][] ="El passwords debe tener al menos 6 caracteres";
        else if($this->password!==$password2)
        self::$alertas['error'][] ="Los password no concuerdan";
        return self::$alertas;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function verificaPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = md5(uniqid());
    }

    public function validarEmail(){
        if(!$this->email)
            self::$alertas['error'][]="El correo no puede estar vacío.";
        else if(!filter_var($this->email,FILTER_VALIDATE_EMAIL))
        self::$alertas['error'][]="Email no válido.";
        return self::$alertas;
    }
    public function validarPassword(){
        if(!$this->password)
            self::$alertas['error'][]="Por favor ingrese la nueva contraseña.";
        else if(strlen($this->password)<6)
        self::$alertas['error'][]="La contraseña debe tener al menos 6 caracteres.";
        return self::$alertas;
    }

    public function validarLogin(){
        if(!$this->password)
            self::$alertas['error'][]="Por favor ingrese la contraseña.";
        else if(strlen($this->password)<6)
        self::$alertas['error'][]="La contraseña debe tener al menos 6 caracteres.";
        $this->validarEmail();
        return self::$alertas;
    }
}