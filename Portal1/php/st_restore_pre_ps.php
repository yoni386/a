<?php
include("configPDO.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_GET["post_entry_data"])) {

        $req_id = $_GET["post_entry_data"];


        function fn_select_ref_id() {

            global $dbh, $req_id;

            $stmt = $dbh->prepare("SELECT ref_id FROM table_vm_restore_state1 where ref_id = :req_id");
            $stmt->bindParam(':req_id', $req_id);
            $stmt->execute();
            $count_chk = $stmt->rowCount();


            if ($count_chk === 0) {

                $count_chk_res = false;

            }

            else {

                $count_chk_res = true;
            }

            return $count_chk_res;

        }


        $stmt = $dbh->prepare("SELECT * FROM table_vm_restore_form1 where id = :req_id");

        $stmt->bindParam(':req_id', $req_id);

        $result_stmt = $stmt->execute();


        if (!$result_stmt) {

            $arr = array('msg' => '', 'error' => "pre_start_error");
            $jsn = json_encode($arr);
            print_r($jsn);
            exit(1);
        }

        $stmtrecords = $stmt->fetchAll();
        foreach ($stmtrecords as $row) {

            "<td>$row[0]</td>";
            "<td>$row[1]</td>";
            "<td>$row[2]</td>";
            "<td>$row[3]</td>";
            "<td>$row[4]</td>";
            "<td>$row[5]</td>";

        }

        $id         = $row[0];
        $vm_name    = $row[1];
        $date       = $row[2];
        $req        = $row[3];
        $owner      = $row[4];

        $req_id     = $id;


        $output_fn_select_ref_id = fn_select_ref_id();

        if (!$output_fn_select_ref_id) {


            $stmt = $dbh->prepare("INSERT INTO table_vm_restore_state1 (ref_id, vm_name) VALUES (?, ?)");
            $stmt->bindParam(1, $req_id);
            $stmt->bindParam(2, $vm_name);


            $result_stmt = $stmt->execute();

            if (!$result_stmt) {

                $arr = array('msg' => '', 'error' => "insert-error");
                $jsn = json_encode($arr);
                print_r($jsn);
                exit(1);
            }


            $state_id = $dbh->lastInsertId();

            if (!$state_id) {
                $arr = array('msg' => '', 'error' => "insert-error");
                $jsn = json_encode($arr);
                print_r($jsn);
                exit(1);
            }

            else {
                $arr = array('msg' => "$req_id", 'state_id' => "$state_id", 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
            }


        }

        else {

            $stmt = $dbh->prepare("SELECT id FROM table_vm_restore_state1 where ref_id = :req_id");
            $stmt->bindParam(':req_id', $req_id);
            $stmt->execute();

            $state_id = $stmt->fetch();
            $state_id = $state_id[0];

            $arr = array('msg' => "$req_id", 'state_id' => "$state_id", 'error' => '');
            $jsn = json_encode($arr);
            print_r($jsn);
        }


    }


    else {

        $arr = array('msg' => '', 'error' => "pre-restore--error");
        $jsn = json_encode($arr);
        print_r($jsn);

    }

}
?>

