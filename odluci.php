<?php
include_once 'dbConfig.php';   
session_start();
$_SESSION['username'] = $_POST['username'];
$_SESSION['passw']= $_POST['passw'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{ 
	$user=$_POST['username'];
	$passw=$_POST['passw'];
	$query="SELECT username FROM vlasnik WHERE username='$user' AND passw='$passw'";
	$res=pg_query($cn,$query);
	$row=pg_numrows($res);
  if ($row==0) 
  { 
		echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
    ?>
    <script>alert("Pogresno ste uneli username ili password, molimo Vas unesite ponovo");</script>
    <?php
  } 
	else
	{
  ?>

  <link rel="stylesheet" href="odluci.css">
  <div class="odluci">
  <div class="gore">
  <?php
  $user=$_POST['username'];
  $upit="SELECT ime,rasa,slika,izlozbaid,statusp FROM pas full outer JOIN prijava ON id = pasid where vlasnik='$user';";
	$rezultat=pg_query($cn,$upit);
	$da=pg_numrows($rezultat);
	?>
	<link rel="stylesheet" href="pas1.css">
		<div class="table-psi3">
   		<div class="header">Status pasa vlasnika: <?php echo "$user"?></div>
   		<table cellspacing="0">
      	<tr>
         <th>Ime psa</th>
		     <th>Rasa</th>
         <th>Slika</th>
         <th>Izlozba</th>
         <th>Status</th>
      	</tr>
    	<?php
      if($da>0)
      {
    		while ($row = pg_fetch_array($rezultat)) {
            $ime=$row['ime'];
            $rasa=$row['rasa'];
        		$imageURL = 'images/'.$row['slika'];
        		$status=$row['statusp'];
        		$izlozba=$row['izlozbaid'];
            if($izlozba!=null)
            {
        		$q1="SELECT naziv FROM izlozba WHERE id=$izlozba";
    			  $r1=pg_query($cn,$q1);
    			  $nesto="";
   				  while ($row1 = pg_fetch_array($r1)) {
        		$nesto=$row1['naziv'];
        	  }
            }
            else
            {
              $nesto="";
            }
    	?> 
     	  <tr>
          <td><?php echo "$ime"?></td>
          <td><?php echo "$rasa"?></td>
          <td><img class="slika3" src="<?php echo $imageURL; ?>" alt="" /></td>
          <td><?php echo "$nesto"?></td>
          <?php 
          if($nesto!="")
          {
            if($status=='t')
            {
              ?>
              <td><img src="pocetna/ok.png" height='25' width='25' class="status"></td>
              <?php
            }
            else
            {
              ?>
              <td><img src="pocetna/not.png" height='25' width='25' class="status"></td>
            <?php   
            }
          }
        else
        {
          ?>
          <td></td>
          <?php
        }
        ?> 
        </tr>
      <?php
	    }
	    }
	  else{
      ?>
      <tr><td><?php echo "Trenutno nemate dodate pse, mozete kreirati u okviru forme dodaj psa.";?></td> 
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      </tr>
      <?php
	  }
	echo "</table>";
	echo "</div>";
	?>
  </div>
<div class="row">
<form action="forma.php" method="post">
  <div class="column">
 <!-- <img src="pocetna/Screenshot_83.png" class="rowslika">-->
  <button type="submit" name="dodaj">Dodaj psa</button>  
  </div>
</form>
<form action="formaPrijava.php" method="post">
  <div class="column1">
 <!-- <img src="pocetna/Screenshot_84.png" class="rowslika">-->
  <button type="submit" name="prijavi">Prijavi psa na izlozbu</button>   
  </div>
</form>
<form action="odjavaPsa.php" method="post">
  <div class="column1">
  <!--<img src="pocetna/Screenshot_85.png" class="rowslika"> -->
  <button type="submit" name="odjavi">Odjavi psa sa izlozbe</button>  
  </div>
</form>
<form action="index.php" method="post">
  <div class="column1">
  <!--<img src="pocetna/Screenshot_85.png" class="rowslika"> -->
  <button type="submit" name="izadji">Vrati se na pocetnu</button>  
  </div>
</form>
</div> 
</div>
<?php
    }
}
?>