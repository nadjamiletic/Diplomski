<?php
include_once 'dbConfig.php';
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['passw'];
$ime=$_POST['ime'];    
$pol=$_POST['pol'];  
$rasa=$_POST['rasa'];
$tezina=$_POST['tezina'];
$starost=$_POST['starost'];
$targetDir="images/";
$targetFilepath="";
$fileName="";
$status = $statusMsg = ''; 
if(isset($_POST["uploadfile"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) 
    {
        $fileName = basename($_FILES["image"]["name"]); 
        $slika=$username."_".$ime."_".$fileName;
        //$targetFilepath=$targetDir.$fileName;
        $targetFilepath=$targetDir.$slika;
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            if(move_uploaded_file($image,$targetFilepath))
            {
                $query =
                "INSERT INTO pas(ime,pol,rasa,slika,tezina,starost,vlasnik) 
                VALUES ('$ime','$pol','$rasa','".$slika."','$tezina','$starost','$username')";      
                $result=pg_query($cn,$query); 
                if(!$result) {
                    echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
                    ?>
                    <script>alert("Molimo Vas pokusajte ponovo.");</script>
                    <?php
                } 
                else 
                {
                    echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
                    ?>
                    <script>alert("Uspesno ste dodali svog psa.");</script>
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
        else{ 
            echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
            ?>
            <script>alert("Samo JPG, JPEG, PNG, & GIF fajlovi su dozvoljeni.");</script>
            <?php

        } 
    }
    else
    { 
        echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
            ?>
            <script>alert("Molimo Vas da selektujete sliku.");</script>
            <?php 
    }   
}    
pg_close();
?>