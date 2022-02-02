<?php

require "../dbBroker.php";
require "../models/intervencija.php";

if(isset($_POST['id'])){
    $myArray = Intervencija::getById($_POST['id'], $conn);
    echo json_encode($myArray);
}

?>