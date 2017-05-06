<!--
Autor: Albert Cadena Rubio
Data última modificació: 29/03/2017
Objectiu: S'encarrega de crear el pdf del menú i ho envia per correu.
Fitxers relacionats:
-->
<?php

require '../connection.php';

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$nom_usuari = $_SESSION['nom_usuari'];
$tipus = $_SESSION['tipus'];

$connexio = new Connexio();
/*
$_POST["primersPlats"];
$_POST["segonsPlats"];
$_POST["postresPlats"];
$_POST["confirmarCrearMenu"];

$_SESSION["primersPlats"]
$_SESSION["segonsPlats"]
$_SESSION["postresPlats"]
*/
if(isset($_POST["confirmarCrearMenu"])){
    if (isset($_SESSION["primersPlats"])) {
        $llistatprim = $_SESSION["primersPlats"];
        echo 'Primers:';
        foreach ($llistatprim as $selectedOption) {
            echo $selectedOption . "\n";
        }
    }
}
/*
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();
*/


function enviarMenuAPDF() {
    $query = "";
    echo $query;

    if ($connexio->query($query) == true) {
        echo 'Dades editades correctament';
        header('Refresh: 0; URL = llistatPlats.php');
    } else {
        echo 'No s\'ha pogut editar el plat';
    }
}

?>
