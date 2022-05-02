<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

    require('DankiCode/Application.php');
    require('DankiCode/Controllers/HomeController.php');
    require('DankiCode/Controllers/RegistrarController.php');
    require('DankiCode/Controllers/ComunidadeController.php');
    require('DankiCode/Controllers/PerfilController.php');
    require('DankiCode/Controllers/PerfilEditarController.php');
    require('DankiCode/Bcrypt.php');
    require('DankiCode/MySql.php');
    require('DankiCode/Utilidades.php');
    require('DankiCode/Models/UsuariosModel.php');
    require('DankiCode/Models/HomeModel.php');
    require('DankiCode/Views/MainView.php');

    require('vendor/autoload.php');

    define('INCLUDE_PATH_STATIC','http://localhost/projeto_redesocial_danki/DankiCode/Views/pages/');
    define('INCLUDE_PATH','http://localhost/projeto_redesocial_danki/');

    $app = new DankiCode\Application();

    $app->run();

?>