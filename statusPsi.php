<?php
include_once 'dbConfig.php';
session_start();
$_SESSION['izlozba']=$_POST['vidi'];
$izlozba=$_SESSION['izlozba'];
$q="SELECT pasid,uplata,statusp from prijava where izlozbaid=$izlozba";
$r=pg_query($cn,$q);
$da=pg_numrows($r);
$upit="SELECT naziv from izlozba where id=$izlozba";
$res=pg_query($cn,$upit);
$nesto="";
while ($red = pg_fetch_array($res))
{
    $nesto=$red['naziv'];
}
?>
<html>
<body>
<link rel="stylesheet" href="pas1.css">
<form action="statusPak.php" method="post">		
	<div class="table-psis">
   	<div class="header">Psi sa izlozbe: <?php echo "$nesto"?></div>
   	<table cellspacing="0">
    <tr>
    <th>ID psa</th>
	<th>Uplata</th>
    <th>Status</th>
    <th>Promeni status</th>
    </tr>
    <?php
    if($da>0)
    {
    while ($row = pg_fetch_array($r)) {
        $idPsa=$row['pasid'];
        $ime=$row['uplata'];
        $dokument = 'documents/'.$row['uplata'];
        $ext = pathinfo($ime, PATHINFO_EXTENSION);
        $status=$row['statusp'];
        ?> 
     	<tr>
		    <td><input name="id" class="input" value="<?php echo "$idPsa"?>"></td>
            <form name="login" action="statusPak.php" method="post">
            <td><button type="submit" name="dokument" value="<?php echo "$ime"?>" class="zvezdica">Vidi dokument</button></td>
            </form>
            <?php
        if($status=='t')
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
        <td><button type="submit" name="vidi1" value="<?php echo "$idPsa"?>" class="zvezdica" >Promeni status</button></td>
      </tr>
      <?php
    }
    }
    else{
        ?>
        <tr><td><?php echo "Trenutno nema prijavljenih psa na ovoj izlozbi.";?></td>
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
pg_close();
?>

