<?php
include_once 'dbConfig.php'; 
session_start();
$_SESSION['userL'] = $_POST['userL'];
$_SESSION['passL']= $_POST['passL'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{ 
    $user=$_SESSION['userL'];
	$passw=$_SESSION['passL'];
	$query=
	"SELECT username FROM kreatorizlozbe WHERE username='$user' AND passw='$passw'";
	$res=pg_query($cn,$query);
	$row=pg_numrows($res);
    if ($row==0) 
    { 
	    echo "<script>setTimeout(\"location.href = 'kreatorPrijava.html';\",500);</script>";
        ?>
        <script>alert("Pogresno ste uneli korisnicko ime ili lozinku. Molimo Vas unesite ponovo.");</script>
        <?php
    } 
	else
	{
	    include_once 'dbConfig.php';
        $_SESSION['userL'] = $_POST['userL'];
        $username=$_SESSION['userL'];
	    $upit="SELECT * FROM izlozba where kreator='$username';";
	    $rezultat=pg_query($cn,$upit);
	    $da=pg_numrows($rezultat);
	    ?>
	    <html>
	    <body>
	    <link rel="stylesheet" href="pas1.css">
	    <form action="statusPsi.php" method="post">		
		<div class="table-psi">
   		<div class="header">Izlozbe kreatora: <?php echo "$username"?></div>
   		<table cellspacing="0">
      	<tr>
		    <th>Naziv</th>
            <th>Grad</th>
            <th>Datum</th>
            <th>Status aktivnosti</th>
            <th>Vidi pse</th>
      	</tr>
    	<?php
        if($da>0)
        {
    		while ($row = pg_fetch_array($rezultat)) {
        		$id=$row['id'];
        		$naziv=$row['naziv'];
                $grad=$row['grad'];
        		$datum=$row['datum'];
        		$aktivna=$row['aktivna'];
    	?> 
     	    <tr>
		    <input type="hidden" name="id" class="input" value="<?php echo "$id"?>">
            <td><?php echo "$naziv"?></td>
            <td><?php echo "$grad"?></td>
            <td><?php echo "$datum"?></td>
            <?php 
            if($aktivna=='t')
            {
                ?>
                <td><img src="pocetna/ok.png" height='25' width='25' id="slika"></td>
                <td><button type="submit" name="vidi" value="<?php echo "$id"?>" class="zvezdica" >Vidi pse</button></td>
                <?php
            }
            else
            {
                ?>
                <td><img src="pocetna/not.png" height='25' width='25' id="slika"></td>
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
            <tr><td class="else"><?php echo "Trenutno nemate kreirane izlozbe. Mozete kreirati izlozbu u formi ispod.";?></td>
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
    <?php
    include_once 'dodajIzlozbu.php';
    ?>
</body>
</html>
<?php      
    }
}
pg_close();
?>