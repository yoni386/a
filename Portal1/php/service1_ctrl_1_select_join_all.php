<?php
require("configPDO.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $stm = $dbh->prepare("select * from join_form1_state1 ");

    $stm->execute();
    $db_select = json_encode($stm->fetchAll());

    echo $db_select;
}

?>
