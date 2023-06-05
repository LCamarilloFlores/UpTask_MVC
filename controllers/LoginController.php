<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){
        if(esPost($_SERVER)){
        }
        $router->render("auth/login",[
            'titulo'=> "Iniciar Sesión"
        ]);
    }
    public static function logout(Router $router){
        if(esPost($_SERVER)){
            echo "Desde Post";
        }
        echo "Desde Logout";
    }
    public static function crear(Router $router){
        $usuario = new Usuario;
        if(esPost($_SERVER)){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta($_POST['password2']);
        }
        $router->render("auth/crear",[
            'titulo'=> "Crear cuenta",
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }
    public static function forgot(Router $router){
        if(esPost($_SERVER)){
        }
        $router->render("auth/forgot",[
            'titulo'=> "Recuperar cuenta"
        ]);
    }
    public static function reset(Router $router){
        if(esPost($_SERVER)){
        }
        $router->render("auth/reset",[
            'titulo'=> "Reestablecer Contraseña"
        ]);
    }
    public static function confirmar(Router $router){
        $router->render("auth/confirmar",[
            "titulo" => "Confirmacion"
        ]);
    }
    public static function mensaje(Router $router){
        $router->render("auth/mensaje",[
            "titulo" => "Cuenta creada"
        ]);
    }
}