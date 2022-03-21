<?php
    $host="localhost";
    $user="diplomskrs_postgres";
    $pass="diplomski21";
    $db="diplomskrs_dbIzlozba1";
    $port="5432";
    $cn=pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");
?>