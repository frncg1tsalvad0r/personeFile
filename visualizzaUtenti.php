<?php
    if(isset($_POST["verbo"])) {
        if($_POST["verbo"] == 'eliminaUtente') {
            $con = mysqli_connect("127.0.0.1", "root", "", "persone");
            $query = "SELECT foto FROM utenti WHERE id=$_POST[id_utente]";
            $utenti = mysqli_query($con, $query);
            $utente = mysqli_fetch_assoc($utenti);

            $query = "DELETE FROM utenti WHERE id=$_POST[id_utente]";
            $utenti = mysqli_query($con, $query);
            if($utente["foto"] == "") {
                // Non serve cancellare la foto
            } else {
                // Cancello il vecchio file
                @unlink($nomeFileDestinazione);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%; border-collapse: collapse; border: 2px solid blue
        }

        td {
            border-collapse: collapse; border: 2px solid blue
        }


    </style>
</head>

<body>
    <?php
        $con = mysqli_connect("127.0.0.1", "root", "", "persone");
        $query = "SELECT * FROM utenti";
        $utenti = mysqli_query($con, $query);
    ?>
    <h1>Visualizza Utenti</h1>
    <table>
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>foto</th>
            <th>Modifica</th>
        </tr>
        <?php
            while($utente = mysqli_fetch_assoc($utenti)) {
                echo "
                <tr>
                    <td>$utente[id]</td>
                    <td>$utente[nome]</td>
                    <td><img src='$utente[foto]' alt='$utente[foto]'> </td>
                    <td>
                        <form action='modificaUtente.php' method='POST'>
                            <input type='hidden' name='id_utente' value='$utente[id]'>
                            <button name='verbo' value='modificaUtente'>Modifica</button>
                        </form>
                        <form action='visualizzaUtenti.php' method='POST'>
                            <input type='hidden' name='id_utente' value='$utente[id]'>
                            <button name='verbo' value='eliminaUtente'>Elimina</button>
                        </form>
                    </td>
                </tr>    
                ";
            }
        ?>
    </table>
</body>
</html>