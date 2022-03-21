<?php
include_once 'dbConfig.php';
if(isset($_POST['sampioni']))
{
   $_SESSION['izlozba']=$_POST['niziz'];
   $izlozba=$_SESSION['izlozba'];
   $_SESSION['kategorija']=$_POST['nizkat'];
   $kategorija=$_SESSION['kategorija'];
   $upit="SELECT naziv from izlozba where id=$izlozba;"; //where datum <now()
   $rezultat=pg_query($cn,$upit);
   $nesto="";
   while($red=pg_fetch_array($rezultat))
   {
      $nesto=$red['naziv'];
   }
   $upit1="SELECT unnest(rasa) as r from kategorija where kategorija='$kategorija' order by unnest(rasa) asc;";
   $rez=pg_query($cn,$upit1);
   while($red1=pg_fetch_array($rez))
   {
      $rasa=$red1['r'];
      ?>     
      <link rel="stylesheet" href="glasajIzlozba.css">
      <div class="table-psi">
      <div class="header">Lista pasa na izlozbi: <?php echo "$nesto"?> za kategoriju <?php echo "$kategorija"?> i rasu <?php echo "$rasa"?> </div>
      <table cellspacing="0">
      <tr>
         <th>Slika</th>
         <th>Ime</th>
         <th>Pol</th>
         <th>Tezina</th>
         <th>Starost</th>
         <th>Vlasnik</th>
         <th>Prosecna ocena</th>  
      </tr>
      <?php 
      include_once 'dbConfig.php';
      $avg=0;
    /*$probaju="SELECT max(sumaocena/brojocena) as average,pasid from dostignuce left join 
    pas on pasid=id where rasa='$rasa' and izlozbaid=$izlozba and brojocena>1 group by pasid;";*/
    /*$probaju="SELECT MAX(x.avg) as maks,x.pasid as idpsa
    FROM (SELECT sum(ocena)/count(*) as avg,pasid FROM glasanje left join pas on pasid=id where rasa='$rasa' and izlozbaid=$izlozba group by pasid)x group by x.pasid limit 1;";
   */
      $probaju="SELECT MAX(x.avg) as maks,x.pasid as idpsa
      FROM (SELECT cast(sum(ocena) as float)/cast(count(*)as float) as avg,pasid FROM glasanje left join pas on pasid=id 
      where rasa='$rasa' and izlozbaid=$izlozba group by pasid)x group by x.pasid order by maks desc limit 1;";
      $result=pg_query($cn,$probaju);
      $idn=0;
      while ($rd = pg_fetch_array($result))
      {
        $idn=$rd['idpsa'];
        $avg=$rd['maks'];
      }
      $q="SELECT id,ime,pol,slika,tezina,starost,vlasnik from pas where id=$idn;";
      $r=pg_query($cn,$q);
      while ($row = pg_fetch_array($r)) {
        $imageURL = 'images/'.$row['slika'];
        $ime=$row['ime'];
        $pol=$row['pol'];
        $tezina=$row['tezina'];
        $starost=$row['starost'];
        $vlasnik=$row['vlasnik'];
//eventualno dodati da ide na novu stranu kad je nova izlozba
        ?>
      <tr>
         <td><img src="<?php echo $imageURL; ?>" alt="" /></td>
         <td><?php echo "$ime"?></td>
         <td><?php echo "$pol"?></td>
         <td><?php echo "$tezina"?></td>
         <td><?php echo "$starost"?></td>
         <td><?php echo "$vlasnik"?></td>
         <td><?php echo number_format((float)$avg, 2, '.', '');?></td>
      </tr>
      <?php
      }
   echo "</table>";
   echo "</div>";
   }
}
?>