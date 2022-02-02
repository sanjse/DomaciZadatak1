<?php

require "../dbBroker.php";
require "../models/intervencija.php";

if(isset($_POST['id']) && isset($_POST['naziv']) && isset($_POST['ambulanta']) 
&& isset($_POST['trajanje']) && isset($_POST['korisnikID'])&& isset($_POST['datum'])){

    $novaIntervencija = new Intervencija($_POST['id'],$_POST['naziv'],$_POST['ambulanta'],$_POST['trajanje'],$_POST['datum'],$_POST['korisnikID']);
    $status =Intervencija::update($novaIntervencija,$conn);

    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo "Failed";
    }
}

?>