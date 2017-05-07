<?php
/*
Autor: Albert Cadena Rubio
Data última modificació: 29/03/2017
Objectiu: Mostra el llistat de plats per al Maitre, per que pugui escollir quins
plats farà servir per al menú.
Fitxers relacionats: connection.php, logout.php, crearMenu.php
 *  */
require '../connection.php';

/*$username = $_SESSION['username'];
$password = $_SESSION['password'];
$nom_usuari = $_SESSION['nom_usuari'];
$tipus = $_SESSION['tipus'];

$_SESSION["isEliminar"] = false;
$_SESSION["isEditar"] = false;
$_SESSION["isInsertar"] = false;*/

$connexio = new Connexio();

$query = ("SELECT id, nom, kcal, tipus FROM plats WHERE tipus = 'primer'");
$result = $connexio->query($query);
cargarColumnasValores('Escull 3 primers', 'llistatPrimers[]',$result);


$query = ("SELECT id, nom, kcal, tipus FROM plats WHERE tipus = 'segon'");
$result = $connexio->query($query);
cargarColumnasValores('Escull 3 segons', 'llistatSegons[]', $result);


$query = ("SELECT id, nom, kcal, tipus FROM plats WHERE tipus = 'postre'");
$result = $connexio->query($query);
cargarColumnasValores('Escull 3 postres', 'llistatPostres[]',$result);

function cargarColumnasValores($titolTaula, $nomSelect, $result) {
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            print json_encode(array_map('utf8_encode',array(
                'estado' => '1',
                'id' => $row["id"], 
                'nom' => $row["nom"], 
                'kcal' => $row["kcal"],
                'tipus' => $row["tipus"])));
        }

    } else {
        $s = split(" " , $titolTaula);
        print json_encode(array('estado' => '2','mensaje' => 'No hi ha '.$s[2].' plats creats'));
    }
}

?>
