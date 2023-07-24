<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use MVC\Router;
use Controllers\LoginController;

$router = new Router();

//Login
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);

//Crear Cuenta
$router->get("/crear", [LoginController::class, "crear"]);
$router->post("/crear", [LoginController::class, "crear"]);

//Recuperar cuenta
$router->get("/forgot", [LoginController::class, "forgot"]);
$router->post("/forgot", [LoginController::class, "forgot"]);

//Resetear password
$router->get("/reset", [LoginController::class, "reset"]);
$router->post("/reset", [LoginController::class, "reset"]);

//Confirmar cuenta
$router->get("/mensaje", [LoginController::class, "mensaje"]);
$router->get("/confirmar", [LoginController::class, "confirmar"]);

//Zona  de proyectos
$router->get("/dashboard", [DashboardController::class, "index"]);
$router->get("/crear-proyecto", [DashboardController::class, "crear_proyecto"]);
$router->post("/crear-proyecto", [DashboardController::class, "crear_proyecto"]);
$router->get("/proyecto", [DashboardController::class, "proyecto"]);
$router->get("/perfil", [DashboardController::class, "perfil"]);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
