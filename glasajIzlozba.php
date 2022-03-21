<?php
include_once 'dbConfig.php';
if(isset($_POST['dugme']))
{
  session_start();
  $_SESSION['broj']=$_POST['dugme'];
  $_SESSION['izl']=$_POST['izlozba'];
  $_SESSION['nizid']=$_POST['id'];
  $_SESSION['kategorija']=$_POST['kategorija'];
  $broj=$_SESSION['broj'];
  $izlozba=$_SESSION['izl'][$broj];
  $idIzlozba=$_SESSION['nizid'][$broj];
  $kategorija=$_SESSION['kategorija'][$broj];
  $upit="SELECT unnest(rasa) as r from kategorija where kategorija='$kategorija' order by unnest(rasa) asc;";
  $rez=pg_query($cn,$upit);
  while($red=pg_fetch_array($rez))
  {
    $rasa=$red['r'];
    ?>     
    <link rel="stylesheet" href="glasajIzlozba.css">
    <div class="table-psi">
    <div class="header">Lista pasa na izlozbi: <?php echo "$izlozba"?> za kategoriju <?php echo "$kategorija"?> i rasu: <?php echo "$rasa"?></div>
    <form action="prijavaSud.php" method="post">
    <table cellspacing="0">
      <tr>
        <!--<th>ID</th>-->
         <th>Slika</th>
         <th>Ime</th>
         <th>Pol</th>
         <th>Tezina</th>
         <th>Starost</th>
         <th>Vlasnik</th>
         <th>Prosecna ocena</th>
         <th>Oceni</th>
         <th></th>
      </tr>
    <?php
    include_once 'dbConfig.php';
   /* $q="SELECT id,ime,pol,slika,tezina,starost,vlasnik,pasid,izlozbaid from pas left join 
    prijava on id=pasid where rasa='$rasa' and izlozbaid=$idIzlozba and statusp='t';";*/
    $q="SELECT distinct p.id,p.ime,p.pol,p.slika,p.tezina,p.starost,p.vlasnik, sum(g.ocena) as suma, count(g.*) as broj  from pas p left join 
    prijava d on p.id=d.pasid left join glasanje g on p.id=g.pasid where rasa='$rasa' and d.izlozbaid=$idIzlozba and d.statusp='t' group by p.id;";
    $r=pg_query($cn,$q);
    while ($row = pg_fetch_array($r)) {
        $id=$row['id'];
        $imageURL = 'images/'.$row['slika'];
        $ime=$row['ime'];
        $pol=$row['pol'];
        $tezina=$row['tezina'];
        $starost=$row['starost'];
        $vlasnik=$row['vlasnik'];
        $suma=$row['suma'];
        $broj=$row['broj'];
        if($broj==0)
          $avg=0;
        else $avg=$suma/$broj;
        ?>
      <tr>
          <input type="hidden" name="id" class="input" value="<?php echo "$id"?>">
          <td><img src="<?php echo $imageURL; ?>" alt="" /></td>
          <td><?php echo "$ime"?></td>
          <td><?php echo "$pol"?></td>
          <td><?php echo "$tezina"?></td>
          <td><?php echo "$starost"?></td>
          <td><?php echo "$vlasnik"?></td>
          <td><?php echo number_format((float)$avg, 2, '.', '');?></td>
          <td>
         <!--<div class="rate">
        <input type="radio" id="star5" name="rate" value="5" />
        <label for="star5" title="text">5 stars</label>
        <input type="radio" id="star4" name="rate" value="4" />
        <label for="star4" title="text">4 stars</label>
        <input type="radio" id="star3" name="rate" value="3" />
        <label for="star3" title="text">3 stars</label>
        <input type="radio" id="star2" name="rate" value="2" />
        <label for="star2" title="text">2 stars</label>
        <input type="radio" id="star1" name="rate" value="1" />
        <label for="star1" title="text">1 star</label>
        </div>
        </td>-->
          <select name="glasanje">
          <option value="1" >1</option>
          <option value="2" >2</option>
          <option value="3" >3</option>
          <option value="4" >4</option>
          <option value="5" >5</option>
          </select>
          </td>
        
          <td><button type="submit" class="zvezdica" name="zvezdica" value="<?php echo "$id"?>">GLASAJ</button></td>
      </tr>
    <?php
    }    
  echo "</table>";
  echo "</form>";
  echo "</div>";
  }
}
?>

