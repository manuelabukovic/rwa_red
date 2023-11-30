<?php
    $email = $_GET['email'];
    $upit = $_GET['upit'];

    echo "Pozdrav $email. Vaš upit je spremljen.<br>";
    echo $upit;

    $server = "student.veleri.hr";
    $database = "oot2_izv";
    $username = "oot2";
    $password ="11";

    $conn = mysqli_connect($server, $username, $password, $database) or 
        die("Konekcija nije uspješna");
    $query = "INSERT INTO kontakt (email, upit) VALUES ('".$email."','".$upit."')";
    $res = mysqli_query($conn, $query);
    if ($res) {
        echo "Podaci su uspješno spremljeni";
    } else {
        echo $query;
    }
    mysqli_close($conn);

?>