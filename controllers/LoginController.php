<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
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
            $existeUsuario = Usuario::where("email",$usuario->email);
            //Si validó correctamente los datos revisa si el usuario ya esta registrado
            if(empty($alertas)){
                if($existeUsuario){
                    Usuario::setAlerta("error","El usuario ya esta registrado");
                    $alertas = Usuario::getAlertas();
                }
                    //Si el Usuario no esta registrado crea la cuenta nueva
                else{
                    //Hashear el password
                    $usuario->hashPassword();
                    //Generar token
                    $usuario->crearToken();
                    //Crea la cuenta nueva
                    $mail = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $mail->enviarConfirmacion();
                    if($usuario->guardar()){
                        header('Location: /mensaje');
                    }
                    
                }
            }
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
        $usuario = Usuario::where("token",$_GET['token']);
        if(!$usuario){
            $mensaje = "El token no es válido.";
        }
        else {
            $usuario->confirmado = 1;
            $usuario->token = "";
            $usuario->guardar();
            $mensaje = "Se ha confirmado la cuenta.";
        }
        $router->render("auth/confirmar",[
            "titulo" => "Confirmacion",
            'mensaje'=>$mensaje
        ]);
    }
    public static function mensaje(Router $router){
        $router->render("auth/mensaje",[
            "titulo" => "Cuenta creada"
        ]);
    }
}