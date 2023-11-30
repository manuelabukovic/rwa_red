<?php
    $id = $_GET['id'];

    //parametri za konekciju
    $server = "student.veleri.hr";
    $database = "oot2_izv";
    $username = "oot2";
    $password ="11"; 

    $conn = mysqli_connect($server, $username, $password, $database) or 
        die("Konekcija nije uspješna");

    $query="SELECT ukupan_broj-rezervirani-iznajmljeni AS slobodni FROM film WHERE id=".$id;

    $res = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($res)){ //ako je slobodni veci od nula mozemo napraviti rezervaciju, odnosno napravit ce se UPDATE (dolje)
        if ($row['slobodni'] <= 0){ 
            echo "Nema slobodnih filmova"; //ako je manji ili jednak nula ispisuje poruku
            exit();
        }
    }

    $query1 = "UPDATE film SET rezervirani=rezervirani+1 WHERE id=".$id;  //$id je adresa gdje se nalazi id filma

    $res1 = mysqli_query($conn, $query1);
    if ($res1) { //ako je rezultat u redu ispisuje se poruka ispod
        echo "Film je uspješno ažuriran"; //kada kliknemo na rezerviraj, podaci u bazi se ažuriraju
    } else {
        echo $query;
    }


    $datenow = new DateTime('now');

    $query2 = "INSERT INTO rezervacija VALUES (NULL, '".date('Y-m-d H:i:s')."', 4, ".$id.")";  //umjesto id smo stavili NULL

    $res2 = mysqli_query($conn, $query2);
    if ($res2) { //ako je rezultat u redu ispisuje se poruka ispod
        echo "Rezervacija je dodana"; //kada kliknemo na rezerviraj, podaci u bazi se ažuriraju
    } else {
        echo $query2;
    }


    mysqli_close($conn);

?>


