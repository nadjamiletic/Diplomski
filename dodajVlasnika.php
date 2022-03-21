<?php
include_once 'dbConfig.php';
    
if(isset($_POST["submit"]))
  {
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $username=$_POST['username'];
    $password=$_POST['passw'];

    $q1="SELECT username FROM vlasnik WHERE username='$username'";
	  $res=pg_query($cn,$q1);
	  $row=pg_numrows($res);
    if ($row>0) 
    {
      echo "<script>setTimeout(\"location.href = 'registrovanje.html';\",500);</script>";
?>
      <script>alert("Ovo korisnicko ime je zauzeto, molimo Vas da unesete drugo.");</script>
      <?php
    }
    else
    {
      $query ="INSERT INTO vlasnik(ime,prezime,username,passw) VALUES ('$ime','$prezime','$username','$password')";
      $result=pg_query($cn,$query);
      if(!$result) {
		    echo "<script>setTimeout(\"location.href = 'registrovanje.html';\",500);</script>";
      ?>
        <script>alert("Molimo Vas pokusajte ponovo.");</script>
        <?php
      } 
      else {
        echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
        ?>
        <script>alert("Uspesno ste kreirali svoj nalog.");</script>
        <?php
      }
    }
  }
  pg_close($cn); 
?>