<!DOCTYPE html>
<html>
<title>IZLOZBA PASA</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="pocetna.css">

<style>
body {font-family: "Cambria"}
.mySlides {display: none}
</style>
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="card">
    <a href="#">POCETNA</a>
    <a href="#izlozbe">IZLOZBE</a>
    <a href="#psisampioni">PSI SAMPIONI</a>
    <div class="dropdown">
      <button class="dropbtn">KATEGORIJE <i class="fa fa-caret-down"></i></button>     
      <div class="dropdown-content">
        <?php
        include_once 'prikaziKategorije.php';
        ?>
      </div>
    </div>
    <a href="registrovanje.html">REGISTRUJ SE</a>
    <a href="prijava.html">PRIJAVI SE</a>
    <a href="kreatorPrijava.html">ORGANIZUJ IZLOZBU</a>
    <a href="sudija.php">SUDIJE</a>
  </div>
</div>


<!-- Page content -->
<div class="strana">

  <!-- Automatic Slideshow Images -->
  <div class="slideshow">
  <div class="mySlides">
  <img src="pocetna/1.jpg" style="width:800px; height: 405px; text-align:center;">
  </div>
  <div class="mySlides">
  <img src="pocetna/2.jpg" style="width: 800px; height: 405px; text-align:center;">
  </div>
  <div class="mySlides">
  <img src="pocetna/3.jpg" style="width: 800px; height: 405px;text-align:center;">
  </div>
  <div class="mySlides">
  <img src="pocetna/4.jpg" style="width:800px;height: 405px;text-align:center;">
  </div>
</div>
  
  <div class="izlozbe" id="izlozbe">
    <h2 class="naslov">AKTIVNE IZLOZBE</h2>
    <br>
    <?php
    include_once 'prikaziIzlozbe.php';
    ?>
  </div>


  <div class="sampioni" id="psisampioni">
  <img src="pocetna/pehar.png">
  <div class="desno">
    <h2>PSI SAMPIONI</h2>
    <p>U ovom odeljku mozete videti pse koji su pobednici na zavrsenim izlozbama po rasama. Odaberite izlozbu i kategoriju kako biste videli dostupne podatke.</p>

    <form action="vidiSampione.php" method="post">
    <div class="katizl">
    <div class="izlozba">Izlozba:
    <select name="niziz" id="izlozba" required>;
    <?php
    include_once 'dbConfig.php';
    $sqli = "SELECT id,naziv FROM izlozba where aktivna='t' and datum>now()::timestamp;"; //treba where datum <now
    $result = pg_query($cn, $sqli);
    while ($row = pg_fetch_array($result)) {
      echo '<option value='.$row['id'].'>'.$row['naziv'].'</option>';
    }
    ?> 
    </select>
    </div>

    <div class="kategorija">Kategorija:
    <select name="nizkat" id="izlozba" required>;
    <?php
    include_once 'dbConfig.php';
    $sqli = "SELECT kategorija FROM kategorija order by kategorija asc;"; //treba where datum <now
    $result = pg_query($cn, $sqli);
    while ($ro = pg_fetch_array($result)) {  
      echo '<option value="'.$ro['kategorija'].'">'.$ro['kategorija'].'</option>';
    }
    ?> 
    </select>
    </div>
    </div>
    <div class="dugsamp">
    <button type="submit" class="dugme1" name ="sampioni">Vidi sampione</button>
    </div>
    </form>
  </div>
  </div>
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}
</script>
</body>
</html>
