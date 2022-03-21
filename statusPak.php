<?php

include_once 'dbConfig.php';

if(isset($_POST["dokument"]))
{
    $ime=$_POST['dokument'];
    $ext = pathinfo($ime, PATHINFO_EXTENSION);
    $dokument='documents/'.$ime;
    if($ext=='pdf')
    {
        header("Content-type: application/pdf");
        header("Content-Length: " . filesize($dokument));
        readfile($dokument);
    }
    else
    {
        ?>
        <img src="<?php echo $dokument; ?>" alt="" />
        <?php
    }
}
?>
<?php
include_once 'dbConfig.php';
if(isset($_POST["vidi1"])){
    session_start();
    $izlozba=$_SESSION['izlozba'];       
    $idPsa=$_POST["vidi1"];
        $q1="SELECT statusp from prijava where pasid=$idPsa and izlozbaid=$izlozba;";
        $r=pg_query($cn,$q1);
        while ($row = pg_fetch_array($r)) {
        $status=$row['statusp'];
        }
        if($status=='t')
            $promena='f';
        else
            $promena='t';
    
        $query ="UPDATE prijava set statusp='$promena' where pasid=$idPsa and izlozbaid=$izlozba;";
        $result=pg_query($cn,$query);
        if(!$result) {
		    echo "<script>setTimeout(\"location.href = 'kreatorPrijava.html';\",500);</script>";
            ?>
            <script>alert("Molimo Vas pokusajte ponovo nakon prijave. ");</script>
            <?php
        } 
        else {
            echo "<script>setTimeout(\"location.href = 'kreatorPrijava.html';\",500);</script>";
            ?>
            <script>alert("Status psa je promenjen. ");</script>
            <?php
        }
}
pg_close($cn); 
?>

