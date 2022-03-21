<?php
include_once 'dbConfig.php';
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['passw'];
$broj=$_POST['prijava'];
$nizid=$_POST['nizid'];
$niziz=$_POST['niziz'];
$id=$nizid[$broj];
$izlozba=$niziz[$broj];
$qrasa="SELECT rasa from pas WHERE id=$id";
$qkat=pg_query($cn,$qrasa);
$rasa="";
while ($row = pg_fetch_array($qkat)) {
    $rasa=$row['rasa'];
}

$kategorija="";
$kategq="SELECT kategorija from kategorija WHERE '$rasa'=ANY(rasa);";
$rkat=pg_query($cn,$kategq);
while ($row = pg_fetch_array($rkat)) {
    $kategorija=$row['kategorija'];
    
}

$targetDir="documents/";
$targetFilepath="";
$fileName="";
if(isset($_POST['prijava']))
{
$fileName = basename($_FILES["image"]["name"][$broj]);
$dokument=$id."_".$fileName; 
$targetFilepath=$targetDir.$dokument;
$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
$allowTypes = array('jpg','png','jpeg','pdf'); 
if(in_array($fileType, $allowTypes)){ 
    $image = $_FILES['image']['tmp_name'][$broj]; 
    $imgContent = addslashes(file_get_contents($image)); 
    if(move_uploaded_file($image,$targetFilepath))
    {
        $upit="SELECT * FROM prijava WHERE izlozbaid=$izlozba and pasid=$id;";
        $rez=pg_query($cn,$upit);
        $broj=pg_numrows($rez);
        if($broj==0) //ukoliko vec nije prijavljen na tu izlozbu
        {
            $query="INSERT INTO prijava(pasid,izlozbaid,uplata,statusp) 
            VALUES ('$id','$izlozba','".$dokument."','f')";
            $result=pg_query($cn,$query);
            if($result)
            {
                echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
                ?>
                <script>alert("Uspesno ste prijavili svog psa na izlozbu. Molimo Vas prijavite se ponovo kako biste proverili podatke.");</script>
                <?php
            }
            else
            {
                echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
                ?>
                <script>alert("Nije uspelo prijavljivanje, pokusajte ponovo.");</script>
                <?php
            }
        }
        else
        {
            echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
            ?>
            <script>alert("Vec ste prijavili psa na ovu izlozbu.");</script>
            <?php
        }
    }
    else
    {
        echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
        ?>
        <script>alert("Nije uspelo smestanje.");</script>
        <?php
    }
}
else
{
    echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
    ?>
    <script>alert("Samo JPG, JPEG, PNG, & PDF fajlovi su dozvoljeni ");</script>
    <?php
}
}
?>