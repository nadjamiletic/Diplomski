<?php
include_once 'dbConfig.php';
session_start();
$username=$_SESSION['userL'];
$izlozba=$_POST['izlozba'];
$datum=$_POST['novidatum'];
if(isset($_POST["izmeni"])){ 
  $query ="UPDATE izlozba set datum='$datum' where id=$izlozba;";
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
    <script>alert("Uspesno ste azurirali svoju izlozbu.");</script>
    <?php
  }
}
pg_close($cn); 
?>
