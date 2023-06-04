<?php

namespace Controllers;

use MVC\Router;

class LoginController{
    public static function login(Router $router){
        if(esPost($_SERVER)){
            echo "Desde Post";
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
        if(esPost($_SERVER)){
            echo "Desde Post";
        }
        $router->render("auth/crear",[
            'titulo'=> "Crear cuenta"
        ]);
    }
    public static function forgot(Router $router){
        if(esPost($_SERVER)){
            echo "Desde Post";
        }
        $router->render("auth/forgot",[
            'titulo'=> "Recuperar cuenta"
        ]);
    }
    public static function reset(Router $router){
        if(esPost($_SERVER)){
            echo "Desde Post";
        }
        echo "Desde reset";
    }
    public static function confirmar(Router $router){
        echo "Desde confirmar";
    }
    public static function mensaje(Router $router){
        echo "Desde mensaje";
    }
}