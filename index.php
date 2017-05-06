<?php

$host = "localhost";
$servername = "restaurantdb";
$username = "root";
$password = "";

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_REQUEST['login']) && !empty($_REQUEST['username']) && !empty($_REQUEST['password'])) {
        $retorno = Connexio::queryLoadUser($_REQUEST['username'], $_REQUEST['password']);
        if ($retorno) {
            //print json_encode(array('estado' => '1', 'mensaje' => 'Bienvenido '.$_SESSION['nom_usuari']));
            if ($_SESSION["tipus"] == "cuiner" || $_SESSION["tipus"] =="maitre") {
                print json_encode(array('estado' => '1', 'mensaje' => 'Bienvenido '.$_SESSION['nom_usuari'], 'tipus' => $_SESSION["tipus"]));
                //header('Location: mainPage.php');
            } else {
                print json_encode(array('estado' => '2', 'mensaje' => 'Rol no válido.'));
            }
        }else{
            print json_encode(array('estado' => '1', 'mensaje' => 'LogIn erroneo.'));
        }
    } else {
        print json_encode(
                        array(
                            'estado' => '2',
                            'mensaje' => 'Faltan Datos para poder Loggear'
                        )
        );
    }
}/*
else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['login']) && !empty($_GET['username']) && !empty($_GET['password'])) {
        $retorno = Connexio::queryLoadUser($_GET['username'], $_GET['password']);
        if ($retorno) {
            //print json_encode(array('estado' => '1', 'mensaje' => 'LogIn correcto.'));
        }else{
            print json_encode(array('estado' => '1', 'mensaje' => 'LogIn erroneo.'));
        }
    } else {
        print json_encode(
                        array(
                            'estado' => '2',
                            'mensaje' => 'Faltan Datos para poder Loggear'
                        )
        );
    }
}*/
?>