<?php
require "dbBroker.php";
require "models/korisnik.php";

session_start();
if(isset($_POST['korisnickoIme']) && isset($_POST['lozinka'])){
    $uname = $_POST['korisnickoIme'];
    $upass = $_POST['lozinka'];

    $korisnik = new Korisnik(1, $uname, $upass);
   
    $odg = Korisnik::logInUser($korisnik, $conn); 
    if($odg->num_rows==1){
        echo  `
        <script>
        console.log( "Uspešno prijavljivanje");
        </script> `;
        $_SESSION['user_id'] = $korisnik->id;
        header('Location: home.php');
        exit();
    }else{
        echo `
        <script>
        console.log( "Neuspešno prijavljivanje!");
        </script>
        `;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Laboratorija</title>
</head>
<body>
<div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <h1 id="naslov"><b>Laboratorija BellaLab</b></h1>

                <div class="forma">
                    <label id="ime">Korisničko ime</label>

                    <input type="text" name="korisnickoIme" class="polje"  required>
                    <br>
                    <br>
                    <br>
                    <label id="sifra">Lozinka</label>
                    <input type="password" name="lozinka" class="polje" required>
                    <br>
                    <br>
                    <br>
                    <button type="submit" id="dugme" name="submit">Prijavi se</button>
                    
                </div>
</body>
</html>