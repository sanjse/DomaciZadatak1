<?php

require "../dbBroker.php";
require "../models/intervencija.php";

if(isset($_POST['id'])){
    $obj = new Intervencija($_POST['id']);
    $status = $obj->deleteById($conn);
    if ($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}

?>