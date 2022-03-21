<?php
include_once 'dbConfig.php';

if(isset($_POST["proba"])){       
    $username=$_POST["proba"];
    $q1="SELECT odobreno from sudija where username='$username';";
    $r=pg_query($cn,$q1);
    while ($row = pg_fetch_array($r)) {
        $status=$row['odobreno'];
    }
    if($status=='t')
        $promena='f';
    else
        $promena='t';
    
    $query ="UPDATE sudija set odobreno='$promena' where username='$username';";
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
        <script>alert("Uspesno ste promenili status sudiji.");</script>
        <?php
    }
}
pg_close($cn); 
?>
