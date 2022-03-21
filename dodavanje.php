<?php
include_once 'dbConfig.php';
session_start();
$username=$_SESSION['userL'];
$naziv=$_POST['naziv'];
$grad=$_POST['grad'];
$datum=$_POST['datum'];
if(isset($_POST["dodaj"])){ 
  $query =
  "INSERT INTO izlozba(naziv,grad,datum,kreator,aktivna,administrator) VALUES ('$naziv','$grad','$datum','$username','false','nadja.miletic')";
  $result=pg_query($cn,$query);
  if(!$result) {
		echo "<script>setTimeout(\"location.href = 'kreatorPrijava.html';\",500);</script>";
    ?>
    <script>alert("Molimo Vas pokusajte ponovo.");</script>
    <?php
  } 
  else 
  {
    echo "<script>setTimeout(\"location.href = 'kreatorPrijava.html';\",500);</script>";
    ?>
    <script>alert("Uspesno ste kreirali izlozbu.");</script>
    <?php
  }
}
pg_close($cn); 
?>
