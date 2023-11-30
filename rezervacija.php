<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoteka</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    <script>
        function rezerviraj(id){
           // alert(id); //klik na rezerviraj izbacuje id filma

            const httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = function(){
                if (httpRequest.readyState == 4){
                     //document.getElementById("prikaz1").innerHTML = httpRequest.responseText;
                     alert (httpRequest.responseText);
                }
            }
            httpRequest.open("GET","php/rezerviraj.php?id="+id);
            httpRequest.send();
        }
    </script>
</head>

<body>
    <div class="w3-bar w3-black">
        <a href="index.html" class="w3-bar-item w3-button">Početna</a>
        <a href="svi_filmovi.html" class="w3-bar-item w3-button">Popis svih filmova</a>
        <a href="rezervacija.php" class="w3-bar-item w3-button">Rezervacija filma</a>
        <a href="kontakt.html" class="w3-bar-item w3-button">Kontakt</a>
    </div>

    <div class="w3-container w3-blue">
        <h1><b>Videoteka</b>
        <img src="image/movie.png" width="50px" alt="">
        </h1>
    </div>
    <div class="w3-container w3-responsive">
    <h2>Rezervacija filma</h2>
    <?php
        $server = "student.veleri.hr";
        $database = "oot2_izv";
        $username = "oot2";
        $password ="11";
    
        $conn = mysqli_connect($server, $username, $password, $database) or 
            die("Konekcija nije uspješna");
        $query = "SELECT * FROM film";
        $res = mysqli_query($conn, $query);
        
    ?>
    <div>
        <table border="1px">
            <tr class="w3-blue">
                <th>Naslov filma</th>
                <th>Osnovne informacije</th>
                <th>Poveznica</th>
                <th>Trailer</th>
                <th>Rezervacija</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($res)){ //dohvacanje jednog po jednog retka u nizu
                echo "<tr>";
                    echo "<td>";
                    echo "<b>".$row['naslov']."</b>"; //dohvacanje naslova te formiranje u celije
                    echo "</td>";
                
                    echo "<td>";
                    echo "<div>" .$row['glumci'] . "</div>"; //dohvacanje glumaca te formiranje u celije
                    echo "</td>";

                    echo "<td>";
                    echo "<div>";
                    echo "<img src='".$row['slika']."' alt='" . $row['naslov']."' width='200'>"; //dohvacanje slika te formiranje u celije
                    echo "</div>";
                    echo "</td>";

                    echo "<td>";   
                    echo $row['trailer'];
                    echo "</td>";

                    echo "<td>";
                    if ($row['ukupan_broj']<= $row['rezervirani']+$row['iznajmljeni']) { //provjera koliko je slobodnih filmova
                        echo "<button disabled>Rezerviraj</button>"; //ako je ukupan broj jednak kao rezervirani ili ako je ukupan broj filmova jednak broj rezervirani+iznajmljeni, button ne radi
                    }
                    else {
                        //echo "<a href='rezerviraj.php?id=".$row['id']."'><button onclick='rezerviraj()'>Rezerviraj</button></a>"; //kada je broj ukupnih filmova veci od rezeriranih ili iznajmljenih moze se stisnuti na gumb te mu se dodaje id
                        echo "<button onclick='rezerviraj(".$row['id'].")'>Rezerviraj</button>";
                    }
                    echo "</td>";
                echo "</tr>";             
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
</div>
<div class="w3-container w3-black">
    <b>Kolegij:</b> Razvoj web aplikacija
    <br>Na kolegiju radimo videoteku s popisom filmova.
</div>
</body>

</html>