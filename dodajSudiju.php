<?php
include_once 'dbConfig.php';
    
if(isset($_POST["submit"]))
  {
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $username=$_POST['userS'];
    $password=$_POST['passS'];
    $kat=$_POST['nizkat'];
    $q1="SELECT username FROM sudija WHERE username='$username'";
	  $res=pg_query($cn,$q1);
	  $row=pg_numrows($res);
    if ($row>0) 
    { 
      echo "<script>setTimeout(\"location.href = 'sudija.php';\",500);</script>";
      ?>
      <script> alert("Ovo korisnicko ime vec postoji, molimo Vas unesite drugo.");</script>
      <?php
    }
    else
    {
      $query =
      "INSERT INTO sudija(ime,prezime,username,pass,kategorija,odobreno,administrator) VALUES ('$ime','$prezime','$username','$password','$kat','false','nadja.miletic')";
      $result=pg_query($cn,$query);
      if(!$result) { 
		    echo "<script>setTimeout(\"location.href = 'sudija.php';\",500);</script>";
        ?>
        <script> alert("Molimo Vas pokusajte ponovo.");</script>
        <?php
      } 
      else {
        echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
        ?>
        <script> alert("Uspesno ste kreirali svoj nalog.");</script>
       <?php
      }
    }
}
pg_close($cn); 
?>