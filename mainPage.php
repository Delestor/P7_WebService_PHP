
<?php

/*
Autor: Albert Cadena Rubio
Data última modificació: 29/03/2017
Objectiu: Gestiona quina será la pantalla d'inici de l'usuari entrat. Depenent
si es valida com a 'cuiner' o 'maitre'.
Fitxers relacionats: cuiner/llistatPlats.php, maitre/llistatPlats.php, logout.php
 *  */
    ob_start();
    session_start();

    $connexio = $_SESSION['conexion'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $nom_usuari = $_SESSION['nom_usuari'];
    $tipus = $_SESSION['tipus'];

    //echo 'Benvingut ' . $nom_usuari . ', ets un ' . $tipus;
    if ($tipus == "cuiner") {
        //header('Refresh: 2; URL = cuiner/llistatPlats.php');
        //header('Location: cuiner/llistatPlats.php');
    } else if ($tipus == "maitre") {
        //header('Refresh: 2; URL = maitre/llistatPlats.php');
        //header('Location: maitre/llistatPlats.php');
    }
    
    
?>


