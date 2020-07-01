<?php
$hostname = 'localhost';
$username = 'root';
$password = 'pass';
$dbname   = 'db_vm_restore_form1';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>


