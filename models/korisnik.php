<?php

class Korisnik{
    public $id;
    public $korisnickoIme;
    public $lozinka;

    public function __construct($id=null,$username=null,$password=null){
        $this->id = $id;
        $this->korisnickoIme = $username;
        $this->lozinka = $password;  }

    public static function logInUser($kor, mysqli $conn)
    {
        $query = "SELECT * FROM korisnik WHERE korisnickoIme='$kor->korisnickoIme' and lozinka='$kor->lozinka'";
        
        return $conn->query($query);
    }
}


?>