<?php
require("configPDO.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_GET["data"])) {

        $req_id = $_GET["data"];

        $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where id = :req_id");

        $stmt->bindParam(':req_id', $req_id);

        $result_stmt = $stmt->execute();


        if (!$result_stmt) {

            $arr = array('msg' => '', 'error' => "delete-error1");
            $jsn1 = json_encode($arr);
            print_r($jsn);
            exit(1);
        }

        $stmtrecords = $stmt->fetchAll();
        foreach ($stmtrecords as $row) {

            "<td>$row[0]</td>";

        }

        $result_state = $row[0];


        if ($result_state === '0') {

            $stmt = $dbh->prepare("delete from table_vm_restore_form1 where id = :req_id");

            $stmt->bindParam(':req_id', $req_id);

            $result_stmt = $stmt->execute();


            if (!$result_stmt) {
                $arr = array('msg' => '', 'error' => "delete-error2");
                $jsn = json_encode($arr);
                print_r($jsn);
                exit(1);
            }

            else {
                $arr = array('msg' => "$req_id", 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
                exit(1);
            }

        }

        else {
            $arr = array('msg' => '',  'error' => "delete-error3");
            $jsn = json_encode($arr);
            print_r($jsn);
            exit(1);
        }

    }

    else {
        $arr = array('msg' => '',  'error' => "delete-error4");
        $jsn = json_encode($arr);
        print_r($jsn);
    }

}


?>