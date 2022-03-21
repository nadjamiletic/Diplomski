<?php
include_once 'dbConfig.php';
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['passw'];
$upit="SELECT * FROM pas FULL OUTER JOIN prijava ON id = pasid where vlasnik='$username';";
$res=pg_query($cn,$upit);
$da=pg_numrows($res);		
?>
<link rel="stylesheet" href="pas.css">
<link rel="stylesheet" href="tabelaPas.css">
<style>
button{	
    background-image: url(
      'pocetna/delete.jpg');
    width: 30px;
    height: 30px;
	background-size: cover;
}
</style>
<form action="odjavaN.php" method="post">
	<div class="table-psi">
	<div class="odjava">ODJAVA PSA SA IZLOZBE</div>
   	<div class="header">Lista pasa vlasnika: <?php echo "$username"?></div>
   	<table cellspacing="0">
    <tr>
		<!--<th>Rbr</th>
		<th>ID</th>-->
        <th>Slika</th>
        <th>Ime</th>
        <th>Rasa</th>
        <th>Izlozba</th>
        <th></th>
    </tr>
    <?php
	if($da!=0)
	{
    	include_once 'dbConfig.php';
		$query="SELECT
        id,
        slika,
        ime,
        rasa,
        pasid,
        izlozbaid
        FROM
        pas
        RIGHT JOIN prijava 
        ON id = pasid where vlasnik='$username';";
    	$r=pg_query($cn,$query);
		$broj=0;
    	while ($row = pg_fetch_array($r)) {
        	$id=$row['id'];
        	$imageURL = 'images/'.$row['slika'];
        	$ime=$row['ime'];
        	$rasa=$row['rasa'];
        	$izlozba=$row['izlozbaid'];
        	$q1="SELECT naziv FROM izlozba WHERE id=$izlozba";
    		$r1=pg_query($cn,$q1);
    		$nesto="";
   			while ($row1 = pg_fetch_array($r1)) {
        		$nesto=$row1['naziv'];
        	}
			//da se ne bi video id i rbr obrisano je u th i dole kod input nije stavljeno ispred input <td>, takodje dodato je type="hidden" 
    ?>
      
     	<tr>
			<input type="hidden" name="broj" class="input" value="<?php echo "$broj"?>">
			<input type="hidden" name="nizid[]" class="input" value="<?php echo "$id"?>">
        	<td><img src="<?php echo $imageURL; ?>" alt="" /></td>
        	<td><?php echo "$ime"?></td>
        	<td><?php echo "$rasa"?></td>
        	<td><input name="niziz[]" class="inputizlozbaid" value="<?php echo "$nesto"?>"></td>
        	<td><button type="submit" class="dugme" name="dugme" value="<?php echo "$broj"?>"></button></td>
      	</tr>
    <?php
			$broj=$broj+1;
		}
		echo "</table>";
		echo "</div>";
	}
	else{
		?>
		<tr><td class="else"><?php echo "Trenutno nemate prijavljene pse na izlozbama.";?></td> 
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		</table>
		</div>
		<div class="linker"> <a href="prijava.html">PRIJAVITE SE PONOVO KAKO BISTE PRIJAVILI PSA NA IZLOZBU</a></div>
	<?php
	}
	?>
	</form>
</body>
</html>
<?php	       
pg_close();
?>


