<form action="vidiPse.php" method="post">  
<div class="dropdown-content">    
    <?php
    include_once 'dbConfig.php';
    $query="SELECT kategorija FROM kategorija order by kategorija asc;";
    $result = pg_query($cn, $query);
    while ($row = pg_fetch_array($result)) {
        ?>
        <button name ="kategorija" value="<?php echo $row['kategorija'];?>"><?php echo $row['kategorija']?></button>
        <?php
    }
    ?>   
</div>     
</form>     

