<html>
<body>
    <link rel="stylesheet" href="pocetna.css">
<div class="containers">
<form action="glasajIzlozba.php" method="post" enctype="multipart/form-data">        
    <?php
    include_once 'dbConfig.php';
    $query="SELECT id,naziv,grad,datum FROM izlozba where aktivna='t' and datum>now()::timestamp;";
    $result = pg_query($cn, $query);
    $broj=0;
    while ($row = pg_fetch_array($result)) {
        $naziv=$row['naziv'];
        $id=$row['id'];
        echo '<div class="kontejner">';
        ?>
        <input type="hidden" name="broj" value="<?php echo "$broj"?>">
        <input type="hidden" name="id[]" value="<?php echo "$id"?>">
        <input name="izlozba[]" value="<?php echo "$naziv"?>">
        <?php
        //echo '<p><b>'.$row['naziv'].'</b></p>';
        echo '<p><b>Grad: '.$row['grad'].'</b></p>';
        echo '<p class="w3-opacity">'.$row['datum'].'</p>';
        ?>
        <div>Kategorija:
        <select name="kategorija[]" id="kategorija" required>
        <?php
        include_once 'dbConfig.php';
        $sqli = "SELECT kategorija FROM kategorija order by kategorija asc;";
        $r = pg_query($cn, $sqli);
        while ($ro = pg_fetch_array($r)) {
            echo '<option value="'.$ro['kategorija'].'">'.$ro['kategorija'].'</option>';
        }
        ?>
        </select>
        </div>
        <button type="submit" class="dugme" name ="dugme" value=<?php echo "$broj";?>>Vidi izlozbu</button>
        <?php
        echo '</div>';
        $broj=$broj+1;
    }
pg_close();
?>        
</form>         
</div>
</body>
</html>


