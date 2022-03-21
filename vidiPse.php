<?php
include_once 'dbConfig.php';
$izl=$_POST['kategorija'];
?>
<link rel="stylesheet" href="vidiPse.css">
<div class="table-psi">
   <div class="header">Lista pasa u kategoriji: <?php echo "$izl"?></div>
   <table cellspacing="0">
      <tr>
         <th>Slika</th>
         <th>Rasa</th>
      </tr>
   <?php
   include_once 'dbConfig.php';
   $izlozba=$_POST['kategorija'];
   $q="SELECT unnest(slika) as slika,unnest(rasa) as rasa FROM kategorija WHERE kategorija='$izlozba'";
   $res=pg_query($cn,$q);
   while ($row = pg_fetch_assoc($res)) {
      $imageURL = 'kategorije/'.$row['slika'];
      $rasa=$row['rasa'];
      ?>
      <tr>
         <td><img src="<?php echo "$imageURL"?>" alt="" /></td>
         <td><?php echo "$rasa"?></td>
      </tr>
      <?php
   }
   echo "</table>";
echo "</div>";
pg_close();
?>