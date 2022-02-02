<?php
class Intervencija{
    public $id;   
    public $naziv;   
    public $ambulanta;   
    public $trajanje;   
    public $datum;
    public $korisnikID;
    

    public function __construct($id=null, $naziv=null, $ambulanta=null, $trajanje=null, $datum=null,$korisnikID=null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->ambulanta = $ambulanta;
        $this->trajanje = $trajanje;
        $this->datum = $datum;
        $this->korisnikID=$korisnikID;
    }


    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM intervencije";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn){

        $query = "SELECT * FROM intervencije WHERE id=$id";
        $myObj = array();
        if($msqlObj = $conn->query($query)){
        
            while($red = $msqlObj->fetch_array(1)){
                $myObj[]= $red;
            }
        }

        return $myObj;
    }

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM intervencije WHERE id=$this->id";
        return $conn->query($query);
    }

    public static function update(Intervencija $novaIntervencija, mysqli $conn) {
        $query="UPDATE intervencije set naziv='$novaIntervencija->naziv', ambulanta='$novaIntervencija->ambulanta', trajanje='$novaIntervencija->trajanje', datum='$novaIntervencija->datum', korisnikID='$novaIntervencija->korisnikID' WHERE id='$novaIntervencija->id'";
        return $conn->query($query);
    }

    public static function add(Intervencija $Intervencija, mysqli $conn)
    {
        $query = "INSERT INTO intervencije(naziv, ambulanta, trajanje, datum, korisnikID) VALUES('$Intervencija->naziv','$Intervencija->ambulanta','$Intervencija->trajanje','$Intervencija->datum','$Intervencija->korisnikID')";
        return $conn->query($query);
    }
}

?>