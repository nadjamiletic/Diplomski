<?php
$user=$_SESSION['user'];
include_once 'dbConfig.php';
$_SESSION['user'] = $_POST['user'];
$username=$_SESSION['user'];
$upit="SELECT * FROM sudija where administrator='$user';"; 
$rezultat=pg_query($cn,$upit);
$da=pg_numrows($rezultat);
?>
<html>
<body>
<link rel="stylesheet" href="pas1.css">
<form action="promeniSudija.php" method="post">		
<div class="table-psi1">
   	<div class="header">Sudije:</div>
   	<table cellspacing="0">
      	<tr>
         <!--<th>ID</th>-->
		 <th>Username</th>
         <th>Ime</th>
         <th>Prezime</th>
         <th>Kategorija</th>
         <th>Status odobrenja</th>
         <th>Promeni status</th>
      	</tr>
    	<?php
        if($da>0)
        {
    		while ($row = pg_fetch_array($rezultat)) {
        		$username=$row['username'];
        		$ime=$row['ime'];
                $prezime=$row['prezime'];
        		$kategorija=$row['kategorija'];
        		$odobreno=$row['odobreno'];
                //mozda i zakomentarisati username sudije
    	?> 
     	    <tr>
		    <td><input name="username" class="input" value="<?php echo "$username"?>"></td> 
            <td><?php echo "$ime"?></td>
            <td><?php echo "$prezime"?></td>
            <td><?php echo "$kategorija"?></td>
            <?php 
            if($odobreno=='t')
            {
                ?>
                <td><img src="pocetna/ok.png" height='25' width='25' id="slika"></td>
                <?php
            }
            else
            {
                ?>
                <td><img src="pocetna/not.png" height='25' width='25' id="slika"></td>
                <?php   
            }
            ?>
            <td><button type="submit" name="proba" class="zvezdica" value=<?php echo "$username";?>>Promeni status</button></td>      
            </tr>
            <?php
	        }
	    }
	    else
        {
            ?>
            <tr><td><?php echo "Trenutno nema sudija.";?></td>
            <td></td>
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
</form>
</body>
</html>
  