<?php

require "../dbBroker.php";
require "../models/intervencija.php";

if(isset($_POST['naziv']) && isset($_POST['ambulanta']) 
&& isset($_POST['trajanje']) && isset($_POST['korisnikID'])&& isset($_POST['datum'])){

    $intervencija = new Intervencija(null,$_POST['naziv'],$_POST['ambulanta'],$_POST['trajanje'],$_POST['datum'],$_POST['korisnikID']);
    $status = Intervencija::add($intervencija, $conn);

    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo "Failed";
    }
}


?>