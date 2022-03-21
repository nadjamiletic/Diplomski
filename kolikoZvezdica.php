<?php
include_once 'dbConfig.php';
session_start();
if(isset($_POST["submit1"]))
{
  $broj=$_SESSION['broj'];
  $izlozba=$_SESSION['izl'][$broj];
  $idIzlozba=$_SESSION['nizid'][$broj];
  $kategorija=$_SESSION['kategorija'][$broj];
  $ocena=$_SESSION['glasanje'];
  $idPsa=$_SESSION['idPsa']; //pasid
  $user=$_POST['user'];//sudija username
  $pass=$_POST['pass'];
  $query="SELECT username,odobreno,kategorija FROM sudija WHERE username='$user' AND pass='$pass'";
  $odobreno="";
  $kat="";
	$res=pg_query($cn,$query);
  while ($row = pg_fetch_array($res)) {
    $odobreno=$row['odobreno'];
    $kat=$row['kategorija'];
  }
	$row=pg_numrows($res);
  if ($row==0) 
  { 	
		echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
    ?>
    <script>alert("Pogresno ste uneli korisnicko ime ili lozinku. Molimo Vas unesite ponovo.");</script>
    <?php
  } 
	else
	{
    if($odobreno=='t')
    {
      if($kat==$kategorija)
      {
        $query1="SELECT pasid,izlozbaid,sudijauser FROM glasanje WHERE pasid=$idPsa and izlozbaid=$idIzlozba and sudijauser='$user';";
        $result=pg_query($cn,$query1);
        $redovi=pg_numrows($result);
        if($redovi==0)
        {
          $query2="INSERT INTO glasanje(pasid,izlozbaid,sudijauser,ocena) 
          VALUES ('$idPsa','$idIzlozba','$user','$ocena');";
          $res=pg_query($cn,$query2);
          if($res)
          {
            echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
            ?>
            <script>alert("Uspesno ste glasali. Hvala Vam na glasu.");</script>
            <?php
          }
          else
          {
            echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
            ?>
            <script>alert("Nije uspelo glasanje, molimo Vas pokusajte ponovo.");</script>
            <?php
          }
        }
        else
        {
          echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
          ?>
          <script>alert("Vec ste glasali za ovog psa.");</script>
          <?php
        }
      }
      else
      {
        echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
        ?>
        <script>alert("Niste prijavljeni za ovu kategoriju.");</script>
        <?php
      }
    }   
    else
    {
      echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
      ?>
      <script>alert("Nije Vam odobrena mogucnost za glasanje.");</script>
      <?php
    }
  }
}
?>