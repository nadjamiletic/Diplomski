<?php
include_once 'dbConfig.php'; 
session_start();
$_SESSION['user'] = $_POST['user'];
$_SESSION['pass']= $_POST['pass'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{ 
	$user=$_SESSION['user'];
	$passw=$_SESSION['pass'];
	$query="SELECT username FROM administrator WHERE username='$user' AND passw='$passw'";
	$res=pg_query($cn,$query);
	$row=pg_numrows($res);
    if ($row==0) 
    { 
		echo "<script>setTimeout(\"location.href = 'administrator.php';\",500);</script>";
        ?>
        <script>alert("Pogresno ste uneli korisnicko ime ili lozinku. Molimo Vas unesite ponovo.");</script>
        <?php
    } 

	else
	{
        $user=$_SESSION['user'];
	    include_once 'dbConfig.php';
        $_SESSION['user'] = $_POST['user'];
        $username=$_SESSION['user'];
	    $upit="SELECT * FROM izlozba where administrator='$user';"; 
	    $rezultat=pg_query($cn,$upit);
	    $da=pg_numrows($rezultat);
	    ?>
	    <html>
	    <body>
	    <link rel="stylesheet" href="pas1.css">
	    <form action="promeni.php" method="post">		
		<div class="table-psi1">
   		<div class="header">Postojece izlozbe:</div>
   		<table cellspacing="0">
      	<tr>
         <!--<th>ID</th>-->
		 <th>Naziv</th>
         <th>Grad</th>
         <th>Datum</th>
         <th>Kreator</th>
         <th>Status aktivnosti</th>
         <th>Promeni status</th>
      	</tr>
    	<?php

        if($da>0)
        {
    		while ($row = pg_fetch_array($rezultat)) {
        		$id=$row['id'];
        		$naziv=$row['naziv'];
                $grad=$row['grad'];
        		$datum=$row['datum'];
                $kreator=$row['kreator'];
        		$aktivna=$row['aktivna'];
    	?> 
     	    <tr>
		    <input type="hidden" name="id" class="input" value="<?php echo "$id"?>">
            <td><?php echo "$naziv"?></td>
            <td><?php echo "$grad"?></td>
            <td><?php echo "$datum"?></td>
            <td><?php echo "$kreator"?></td>
            <?php 
            if($aktivna=='t')
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
            <td><button type="submit" name="proba" class="zvezdica" value=<?php echo "$id";?>>Promeni status</button></td>      
            </tr>
            <?php
	        }
	    }
	    else
        {
            ?>
            <tr><td><?php echo "Trenutno nema aktivnih izlozbi.";?> </td>
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
<?php  
 include_once 'sudijaKontrola.php';    
    }
}
pg_close();
?>

