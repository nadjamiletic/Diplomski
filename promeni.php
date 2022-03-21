<?php
include_once 'dbConfig.php';

if(isset($_POST["proba"])){       
    $idIzlozbe=$_POST["proba"];
    $q1="SELECT aktivna from izlozba where id=$idIzlozbe;";
    $r=pg_query($cn,$q1);
    while ($row = pg_fetch_array($r)) {
        $status=$row['aktivna'];
    }
    if($status=='t')
        $promena='f';
    else
        $promena='t';

    $query ="UPDATE izlozba set aktivna='$promena' where id=$idIzlozbe;";
    $result=pg_query($cn,$query);
    if(!$result) 
    {
		echo "<script>setTimeout(\"location.href = 'administrator.php';\",500);</script>";
        ?>
        <script>alert("Molimo Vas pokusajte ponovo.");</script>
        <?php
    } 
    else 
    {
        echo "<script>setTimeout(\"location.href = 'administrator.php';\",500);</script>";
        ?>
        <script>alert("Uspesno ste promenili status izlozbe.");</script>
        <?php
    }
}
pg_close($cn); 
?>
