<?php
    if(isset($_POST["verbo"])) {
        if($_POST["verbo"] == 'modificaUtente') {
            $con = mysqli_connect("127.0.0.1", "root", "", "persone");
            $query = "SELECT * FROM utenti WHERE id=$_POST[id_utente]";
            $utenti = mysqli_query($con, $query);
            // Un solo utente
            $utente = mysqli_fetch_assoc($utenti);
        }

        if($_POST["verbo"] == 'confermaModificaUtente') {
            // Modifica utente nel database ed eventuale aggiornamento della foto.
            $nomeFileDestinazione = "img/" .$_POST['id']. "_file.jpg";

            if($_FILES["foto"]["name"] == "") {
                // Non aggiorno la foto

            } else {
                // Cancello il vecchio file e aggiorno la foto
                @unlink($nomeFileDestinazione);
                move_uploaded_file($_FILES["foto"]["tmp_name"], $nomeFileDestinazione);
               
            }
            $con = mysqli_connect("127.0.0.1", "root", "", "persone");
            $query = "UPDATE utenti SET nome='$_POST[nome]', foto='$nomeFileDestinazione' WHERE id=$_POST[id]";
            mysqli_query($con, $query);

            header("Location: visualizzaUtenti.php");
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utenti</title>
</head>
<body>
    <h1>Modifica Utente</h1>
    <form action="modificaUtente.php" method="POST" enctype="multipart/form-data">
        NOME: <input type="text" name="id" value="<?= $utente['id'] ?>" readonly>
        <br>
        NOME: <input type="text" name="nome" value="<?= $utente['nome'] ?>">
        <br><br>
        <img src="<?= $utente['foto'] ?>" alt<?= $utente['foto'] ?>="">
        FOTO: <input type="file" name="foto" value="<?= $utente['foto'] ?>">
        <br><br>
        <button type="submit" name="verbo" value="confermaModificaUtente">Modifica</button>
    </form>
</body>
</html>