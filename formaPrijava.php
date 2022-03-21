<?php
include_once 'dbConfig.php';
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['passw'];
$upit="SELECT * FROM pas where vlasnik='$username';";
$rezultat=pg_query($cn,$upit);
$da=pg_numrows($rezultat);
?>
<html>
<body>
<link rel="stylesheet" href="pas1.css">
<form action="prijaviN.php" method="post" enctype="multipart/form-data">		
<div class="table-psi2">
   	<div class="header">Psi:</div>
   	<table cellspacing="0">
    <tr>
	    <th>Ime</th>
        <th>Slika</th>
        <th>Izlozba</th>
        <th>Potvrda</th>
        <th></th>
    </tr>
    <?php
    $broj=0;
    if($da>0)
    {
        while ($row = pg_fetch_array($rezultat)) {
            $id=$row['id'];
            $ime=$row['ime'];
            $imageURL = 'images/'.$row['slika'];
        
    ?> 
        <tr>
        <input type="hidden" name="broj" class="input" value="<?php echo "$broj"?>">
        <input type="hidden" name="nizid[]" class="input" value="<?php echo "$id"?>">
        <td><?php echo "$ime"?></td>
        <td><img src="<?php echo $imageURL; ?>" alt="" /></td>
        <td><select name="niziz[]" id="izlozba" required>;
        <?php
        include_once 'dbConfig.php';
        $sqli = "SELECT id,naziv FROM izlozba where aktivna='t' and datum>now()::timestamp;";
        $result = pg_query($cn, $sqli);
        while ($row = pg_fetch_array($result)) {
            echo '<option value='.$row['id'].'>'.$row['naziv'].'</option>';
        }
        ?> 
        </select></td>
        <td><input type="file" name="image[]"/></td>
        <td><button type="submit" name="prijava" class="zvezdica" value=<?php echo "$broj";?>>Prijavi psa</button></td>      
        </tr>
        <?php
        $broj=$broj+1;
        }
    }
    else{
        ?>
        <tr><td><?php echo "Trenutno nemate dodatih psa.";?></td> </tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
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