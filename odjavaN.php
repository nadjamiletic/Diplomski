<?php
if(isset($_POST["dugme"]))
{
include_once 'dbConfig.php';
$broj=$_POST['dugme'];
$nizid=$_POST['nizid'];
$niziz=$_POST['niziz'];
$id=$nizid[$broj];
$izlozba=$niziz[$broj];
$q="SELECT id FROM izlozba WHERE naziv='$izlozba';";
$r=pg_query($cn,$q);
$nesto="";
while ($row = pg_fetch_array($r)) {
    $nesto=$row['id'];
}
$query="DELETE FROM prijava WHERE pasid=$id and izlozbaid='$nesto';";
$result=pg_query($cn,$query);
if($result)
{
   	echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
	?>
	<script>alert("Uspesno ste odjavili svog psa sa izlozbe.");</script>
	<?php
}
else
{
	echo "<script>setTimeout(\"location.href = 'prijava.html';\",500);</script>";
	?>
	<script>alert("Nije uspela odjava, molimo Vas pokusajte ponovo.");</script>
	<?php
}
}
?>