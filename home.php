
<?php

require "dbBroker.php";
require "models/intervencija.php";

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
} 
$podaci = Intervencija::getAll($conn);

if (!$podaci) {
    echo "Nastala je greška pri preuzimanju podataka";
    die();
}
if ($podaci->num_rows == 0) {
    echo "Nema zakazanih intervencija";
    die();
} else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/druga.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet">
    <title>BellaLab</title>
</head>
<body>
    <br/><br/>
    <h1 id="naslov">BellaLab zakazane intervencije</h1>  
    <br/>
    <div class="zaglavlje">
      
        <ul class="pozadina">
        <li style="display: inline-block;line-height: 50px;">
        <button id="btnPrikaz" >Prikazi sve intervencije</button></li>
       
        <li style="display: inline-block;line-height: 50px;" >
        <button id="-zakazivanje"type="button"  data-toggle="modal" data-target="#myModal">Zakazi novu intervenciju</button></li>

        <li style="display: inline-block;line-height: 50px;" >
        <div class="col-md-4a">
            <button id="btn-pretraga">Pretrazi intervencije</button>
            <input type="text" id="myInput" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi po nazivu" hidden>
       </div> 
        </li>
        </ul> 
    </div>
<br>
<br>

    <div id="pregled"   style=" background-color: black;
    opacity: 90%; width: 90%; margin-left:auto; margin-right:auto;">
    <br>
   <table id="tabela" style="color: white; background-color: black; width: 95%; margin-left:auto; margin-right:auto;">
  
                <thead class="thead"style="font-size: 40px;  text-align: center;">
                <tr >
                <th class="col" style="width: 30%;">Vrsta intervencije</th>
                <th class="col"style="width: 20%;" >Ambulanta</th>    
                <th class="col"style="width: 15%;" >Trajanje</th>
                <th class="col"style="width: 15%;" >Datum</th>
                <th class="col"style="width: 15%;" >KorisnikID</th>
            </tr>
            
                </thead>
                <tbody>

                    <?php
                   while ($red = $podaci->fetch_array()) :
                    ?>
                        <tr>
                            <td><?php echo $red["naziv"] ?></td>
                            <td><?php echo $red["ambulanta"] ?></td>
                            <td><?php echo $red["trajanje"] ?></td>
                            <td><?php echo $red["datum"] ?></td>
                            <td><?php echo $red["korisnikID"] ?></td>
                        <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="checked-donut" value=<?php echo $red["id"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>

                        </tr>
                <?php
                   endwhile;
                 } ?>

                </tbody>
                </table>
            
            <div class="row">
                <ul class="pozadina"  style="margin-left:5%; margin-top: 50px; ">
                <li style="display: inline-block;  line-height: 50px; ">
                <div class="col-md-1" >
                <button id="dugme-izmeni" style="color:rgb(83, 10, 10); background-color: rgb(250, 234, 230); width: 350px; border:white; border-radius: 10px; font-size: 25px;" 
                 data-toggle="modal" data-target="#izmeniModal">Izmeni zakazanu intervenciju</button>
            
                </div></li> 
                <li style="display: inline-block;   line-height: 50px;">
                <div class="col-md-12" >
                <button id="btn-obrisi"  formmethod="post" style="color:rgb(83, 10, 10); background-color: rgb(250, 234, 230);width: 350px; border:white; border-radius: 10px; font-size: 25px;">Obrisi intervenciju</button>
                </div></li> 
                <li style="display: inline-block;   line-height: 50px;  ">
                <div class="col-md-2" >
                <button id="btn-sortiraj" style="color:rgb(83, 10, 10); background-color: rgb(250, 234, 230); width: 350px; border:white; border-radius: 10px; font-size: 25px;"
                     onclick="sortTable()">Sortiraj po ambulantama</button>
                </div> 
             </li> 
            </ul>
            </div>
       
    </div>

    <div class="modal fade" id="myModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form" >
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color:rgb(83, 10, 10); text-align: left ">Zakazi intervenciju</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label for="">Vrsta intervencije</label>
                                        <input type="text" style="border: 1px solid black; width: 200px;" name="naziv" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ambulanta</label>
                                        <input type="text" style="border: 1px solid black;width: 200px; " name="sala" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ambulanta">Trajanje</label>
                                        <input type="number" style="border: 1px solid black; width: 200px; " name="trajanje" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ambulanta">ID korisnika</label>
                                        <input type="number" style="border: 1px solid black; width: 200px; " name="korisnikID" class="form-control" />
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Datum</label>
                                            <input type="date" style="border: 1px solid black; width: 200px; " name="datum" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="Dodaj" type="submit"  style="color:white; background-color:rgb(83, 10, 10);font-size: 30px; border-radius: 20px">Zakazi intervenciju</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" -default" data-dismiss="modal">Zatvori</button>
                </div>
            </div>

        </div>



    </div>
    <div class="modal fade" id="izmeniModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container prijava-form">
                        <form action="#" method="post" id="izmeniForm">
                            <h3 style="color:rgb(83, 10, 10);">Izmeni zakazanu intervenciju</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="id" type="text" name="id" style="border: 1px solid black; width: 200px; "class="form-control" placeholder="Id *" value="" readonly />
                                    </div>
                                    <div class="form-group">
                                        <input id="naziv" type="text" name="naziv"style="border: 1px solid black; width: 200px; " class="form-control" placeholder="naziv*" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="ambulanta" type="text" name="ambulanta" style="border: 1px solid black; width: 200px; "class="form-control" placeholder="ambulanta *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="trajanje" type="number" name="trajanje"style="border: 1px solid black; width: 200px; " class="form-control" placeholder="trajanje(min) *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="datum" type="date" name="datum"style="border: 1px solid black; width: 200px; " class="form-control" placeholder="Datum *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="korisnikID" type="number" name="korisnikID"style="border: 1px solid black; width: 200px; " class="form-control" placeholder="id korisnika(1, 2 ili 3) *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit"  style=" color:white; background-color:rgb(83, 10, 10);font-size: 30px; border-radius: 20px"> Izmeni intervenciju
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" -default" data-dismiss="modal">Zatvori</button>
                </div>
            </div>



        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("tabela");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[1];
                    y = rows[i + 1].getElementsByTagName("TD")[1];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        function funkcijaZaPretragu() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabela");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


</body>

</html>

