<?php
include_once 'dbConfig.php';
    
if(isset($_POST["submit"]))
{
  $ime=$_POST['ime'];
  $prezime=$_POST['prezime'];
  $username=$_POST['userS'];
  $password=$_POST['passS'];
  $email=$_POST['email'];
  $kontakt=$_POST['kontakt'];
  $q1="SELECT username FROM kreatorizlozbe WHERE username='$username'";
	$res=pg_query($cn,$q1);
	$row=pg_numrows($res);
  if ($row>0) 
  { 
    echo "<script>setTimeout(\"location.href = 'kreatorPrijava.html';\",500);</script>";
    ?>
    <script> alert("Ovo korisnicko ime vec postoji, molimo Vas unesite drugo.");</script>
    <?php
  }
  else
  {
    $query =
    "INSERT INTO kreatorizlozbe(username,ime,prezime,passw,email,kontakt) VALUES ('$username','$ime','$prezime','$password','$email','$kontakt')";
    $result=pg_query($cn,$query);
    if(!$result) 
    {
		  echo "<script>setTimeout(\"location.href = 'kreatorPrijava.html';\",500);</script>";
      ?>
      <script> alert("Molimo Vas pokusajte ponovo.");</script>
      <?php
    } 
    else 
    {
      echo "<script>setTimeout(\"location.href = 'kreatorPrijava.html';\",500);</script>";
      ?>
      <script> alert("Uspesno ste kreirali svoj nalog. Za dalji rad sa izlozbama, morate se prijaviti.");</script>
      <?php
    }
  }
}
pg_close($cn); 
?>