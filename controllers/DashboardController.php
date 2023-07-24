<?php

namespace Controllers;

use MVC\Router;
use Model\Proyecto;

class DashboardController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();
        $id = $_SESSION['id'];
        $proyectos = Proyecto::belongsTo('propietarioId', $id);
        $router->render("dashboard/index", [
            "titulo" => "Proyectos",
            "proyectos" => $proyectos,
        ]);
    }
    public static function crear_proyecto(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];

        if (esPost($_SERVER)) {
            $proyecto = new Proyecto($_POST);
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                $proyecto->obtenerUrl();
                $proyecto->propietarioId = $_SESSION['id'];
                $proyecto->guardar();
                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }
        $router->render("dashboard/crear-proyecto", [
            "alertas" => $alertas,
            "titulo" => "Crear Proyecto"
        ]);
    }
    public static function perfil(Router $router)
    {
        session_start();
        isAuth();
        $router->render("dashboard/perfil", [
            "titulo" => "Perfil",
        ]);
    }

    public static function proyecto(Router $router)
    {
        session_start();
        isAuth();
        $url = $_GET['id'];

        if (!$url)
            header('Location: /dashboard');

        //Revisar que la persona que visita el proyecto es el creador del mismo
        $proyecto = Proyecto::where('url', $url);
        if ($proyecto->propietarioId !== $_SESSION['id'])
            header('Location: /dashboard');

        $router->render("dashboard/proyecto", [
            "titulo" => $proyecto->proyecto,
        ]);
    }
}
