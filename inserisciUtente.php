<?php
    if(isset($_POST['verbo'])) {
        if($_POST['verbo'] == 'inserisciUtente') {
            echo "Info POST<br>";
            print_r($_POST);

            echo "Info _FILES<br>";
            print_r($_FILES);

             // Inserisci il nuovo utente
             $con = mysqli_connect("127.0.0.1", "root", "", "persone");
             $query = "INSERT INTO utenti (nome) VALUE ('$_POST[nome]')";
             mysqli_query($con, $query);

             $lastId = mysqli_insert_id($con);
            // 1) DOVE DEVO METTERE IL FILE?

            //$nomeFileDestinazione = 'img/' . basename($_FILES["foto"]["name"]);
            $nomeFileDestinazione = "img/" .$lastId. "_file.jpg";
            print_r($nomeFileDestinazione);


            // 2) IL FILE E' DEL FORMATO CORRETTO?
            // facciamo finta che tutto vada bene
            if($_FILES["foto"]["name"] == "") {
            }
            else {
                echo "Info file<br>";
                print_r(getimagesize($_FILES["foto"]["tmp_name"]));

                // 3) ? IL FILE EISTE GIA'
                // facciamo finta che il file nella directory di destinazione non ci sia
                echo "Esiste il file<br>";
                print_r(file_exists($nomeFileDestinazione));

                // 4) FATTO UPLOAD SPOSTO IL FILE NELLA DIRECTOY CORRETTA CHE 
                // HO DEDICATO PER LE IMMAGINI CHE E' RELAZIONATA CON IL DATABASE

                move_uploaded_file($_FILES["foto"]["tmp_name"], $nomeFileDestinazione);
            }


             // Aggiorna il path della foto.
             $con = mysqli_connect("127.0.0.1", "root", "", "persone");
             $query = "UPDATE utenti SET foto='$nomeFileDestinazione' WHERE id=$lastId";
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
    <title>Document</title>
</head>
<body>
    <h1>Inserisci Utente</h1>
    <form action="inserisciUtente.php" method="POST" enctype="multipart/form-data">
        <br>
        NOME: <input type="text" name="nome">
        <br><br>
        FOTO: <input type="file" name="foto">
        <br><br>
        <button type="submit" name="verbo" value="inserisciUtente">Inserisci</button>
    </form>
</body>
</html>