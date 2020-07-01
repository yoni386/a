<?php
require("configPDO.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {


    $stm = $dbh->prepare("SELECT * FROM requestor");

    $stm->execute();
    $db_select = json_encode($stm->fetchAll());

    echo $db_select;
}



?>
