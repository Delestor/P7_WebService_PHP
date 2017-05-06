<!--
Autor: Albert Cadena Rubio
Data última modificació: 29/03/2017
Objectiu: Confirma si el menú que es vol crear és vàlid.
Si tot és vàlid, l'usuari podrá escollir generar un pdf del menú i enviar-ho per mail.
Fitxers relacionats: connection.php, estilos.css, generarPDF.php, mainPage.php
-->
<?php

require '../connection.php';

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$nom_usuari = $_SESSION['nom_usuari'];
$tipus = $_SESSION['tipus'];

$_SESSION["primersPlats"] = null;
$_SESSION["segonsPlats"] = null;
$_SESSION["postresPlats"] = null;

$Max_Num_Plats_Menu = 3;
$Max_Calories = 2500;
$sumaCalories = 0;

$connexio = new Connexio();

function quantesCalories($idPlat, $conn) {
    $query = "SELECT kcal from plats where id = " . $idPlat;
    
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);
    
    return intval($row["kcal"]);
}

echo '<html>
        <head>
            <title>Insert Nou Plat</title>
<link rel="stylesheet" href="../estilos.css" type="text/css">            
</head>
        <body>';
//llistatPrimers
if (isset($_POST["crearNouMenu"])) {
    $dades_correctes = false;
    if (isset($_POST["llistatPrimers"])) {
        $llistatprim = $_POST["llistatPrimers"];
        echo 'Primers:';

        if (count($llistatprim) != $Max_Num_Plats_Menu) {
            $dades_correctes = false;
            echo '<p class="mensaje_error">No son ' . $Max_Num_Plats_Menu . ' primers plats</p>';
        } else {
            $suma = 0;
            foreach ($llistatprim as $e) {
                $suma = $suma + intval(quantesCalories($e, $connexio));
            }
            $sumaCalories = $sumaCalories + $suma;
            
            echo $suma . "kcal";
            //$dades_correctes = true;
        }
        echo '</br>';
        echo 'Listado de platos:';
        foreach ($llistatprim as $selectedOption) {
            echo $selectedOption . "\n";
        }
    }else{
        echo '<p class="mensaje_error">No son ' . $Max_Num_Plats_Menu . ' primers plats</p>';
    }

    if (isset($_POST["llistatSegons"])) {
        $llistatseg = $_POST["llistatSegons"];
        echo '</br>Segons:';

        if (count($llistatseg) != $Max_Num_Plats_Menu) {
            $dades_correctes = false;
            echo '<p class="mensaje_error">No son ' . $Max_Num_Plats_Menu . ' segons plats</p>';
        } else {
            $suma = 0;
            foreach ($llistatseg as $e) {
                $suma = $suma + intval(quantesCalories($e, $connexio));
            }
            $sumaCalories = $sumaCalories + $suma;
            
            echo $suma . "kcal";
            //$dades_correctes = true;
        }
        echo '</br>';
        echo 'Listado de platos:';
        foreach ($llistatseg as $selectedOption) {
            echo $selectedOption . "\n";
        }
    }else{
        echo '<p class="mensaje_error">No son ' . $Max_Num_Plats_Menu . ' segons plats</p>';
    }

    if (isset($_POST["llistatPostres"])) {
        $llistatpostre = $_POST["llistatPostres"];
        echo '</br>Postres:';

        if (count($llistatpostre) != $Max_Num_Plats_Menu) {
            $dades_correctes = false;
            echo '<p class="mensaje_error">No son ' . $Max_Num_Plats_Menu . ' postres</p>';
        } else {
            $suma = 0;
            foreach ($llistatpostre as $e) {
                $suma = $suma + intval(quantesCalories($e, $connexio));
            }
            $sumaCalories = $sumaCalories + $suma;
            
            echo $suma . "kcal";
            $dades_correctes = true;
        }
        echo '</br>';
        echo 'Listado de platos:';
        foreach ($llistatpostre as $selectedOption) {
            echo $selectedOption . "\n";
        }
    }else{
        echo '<p class="mensaje_error">No son ' . $Max_Num_Plats_Menu . ' postres</p>';
    }

    if ($dades_correctes == true) {
        if ($sumaCalories < $Max_Calories) {

            $_SESSION["primersPlats"] = $_POST["llistatPrimers"];
            $_SESSION["segonsPlats"] = $_POST["llistatSegons"];
            $_SESSION["postresPlats"] = $_POST["llistatPostres"];
            echo '<form class="form-menu-plats" role="form" method="post" action="generarPDF.php">';
            /*
              echo '<input type="hidden" name="primersPlats" value='.$_POST["llistatPrimers"].'/>';
              echo '<input type="hidden" name="segonsPlats" value='.$_POST["llistatSegons"].'/>';
              echo '<input type="hidden" name="postresPlats" value='.$_POST["llistatPostres"].'/>';
             */
            echo '<input type="submit" name="confirmarCrearMenu" value="Confirmar Menu">';
            echo '</form>';
        } else {
            echo '<p class="mensaje_error">Has superat les calories maximes d\'un menu: TOTAL = ' . $sumaCalories . 'kcal</p>';
        }
    }
}
echo '<a href="../mainPage.php" class="button"><button>Cancelar</button></a>';
echo '</body>
    </html>';
?>

