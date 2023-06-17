<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){
        $alertas = [];
        if(esPost($_SERVER)){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if(empty($alertas))
            {
                $usuario = Usuario::where("email",$auth->email);
                if($usuario&&$usuario->confirmado){
                    //Se Loguea al usuario
                    if(password_verify($auth->password,$usuario->password))
                    {
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        header("Location: /dashboard");
                    }
                    else
                    Usuario::setAlerta("error","La contraseña ingresada es incorrecta");
                }
                else{
                    Usuario::setAlerta("error","El usuario no esta registrado o su cuenta no esta confirmada");
                }
            }
            $alertas = Usuario::getAlertas();
        }
        $router->render("auth/login",[
            'titulo'=> "Iniciar Sesión",
            'alertas' => $alertas
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
        $alertas=[];
        if(esPost($_SERVER)){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where("email",$usuario->email);
                if($usuario && $usuario->confirmado){
                    //Generar nuevo token
                    $usuario->crearToken();
                    //Actualizar el usuario
                    $usuario->guardar();
                    //Enviar el email
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarInstrucciones();
                    //Imprimir la alerta
                    $alertas['exito'][]= 'Hemos enviado las intrucciones a tu email.';
                }
                else
                $alertas['error'][]="El correo no esta registrado o confirmado.";
            }
        }
        $router->render("auth/forgot",[
            'titulo'=> "Recuperar cuenta",
            'alertas'=> $alertas
        ]);
    }
    public static function reset(Router $router){
        $alertas = [];
        $mostrar = true;
        $token = s($_GET['token']);
        if(!$token)
        header('Location: /');

        //Identificar al usuario con el token
        $usuario = Usuario::where('token',$token);
        if(!$usuario)
            {
                Usuario::setAlerta("error","Token Inválido.");
                $mostrar=false;
            }
        if(esPost($_SERVER)){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();
            if(empty($alertas)){
                $usuario->hashPassword();
                $usuario->token = null;
                //Añadir el nuevo password
                $resultado = $usuario->guardar();
                if($resultado)
                header("Location: /");
            }
        }
        $router->render("auth/reset",[
            'titulo'=> "Reestablecer Contraseña",
            'alertas'=> $alertas,
            'mostrar'=>$mostrar
        ]);
    }
    public static function confirmar(Router $router){
        $alertas=[];
        if(!$_GET['token']){
            header("Location: /");
        }
        $usuario = Usuario::where("token",s($_GET['token']));
        if(!$usuario){
            $alertas['error'][]="Token no válido.";
        }
        else {
            $usuario->confirmado = 1;
            $usuario->token = "";
            $usuario->guardar();
            $alertas['exito'][]="Cuenta confirmada.";
            $alertas = Usuario::getAlertas();
        }
        $router->render("auth/confirmar",[
            "titulo" => "Confirmacion",
            'alertas'=> $alertas
        ]);
    }
    public static function mensaje(Router $router){
        $router->render("auth/mensaje",[
            "titulo" => "Cuenta creada"
        ]);
    }
}