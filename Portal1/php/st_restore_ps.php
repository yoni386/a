<?php
include("configPDO.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_GET["req_id"], $_GET["state_id"])) {

        $req_id   = $_GET["req_id"];

        $state_id = $_GET["state_id"];

        $stmt = $dbh->prepare("SELECT * FROM table_vm_restore_form1 where id = :req_id");

        $stmt->bindParam(':req_id', $req_id);

        $result_stmt = $stmt->execute();

        if (!$result_stmt) {

            $arr = array('msg' => '', 'error' => "start-error1");
            $jsn = json_encode($arr);
            print_r($jsn);

            $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
            $update_state1 = '3';
            $stmt->bindParam(':update_state1', $update_state1);
            $stmt->bindParam(':req_id', $req_id);
            $result_stmt = $stmt->execute();

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
            "<td>$row[6]</td>";
            "<td>$row[7]</td>";
            "<td>$row[8]</td>";
            "<td>$row[9]</td>";

        }


        $req_id          = $row[0];
        $vm_name         = $row[1];
        $vm_ds           = $row[2];
        $vol_name        = $row[3];
        $snap_name       = $row[4];
        $snap_date       = $row[5];
        $requestor_name  = $row[6];
        $requestor_email = $row[7];
        $owner           = $row[8];
        $state           = $row[9];


        function fn_select_state_0 () {

            global $dbh, $req_id;

            $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=0 and id = :req_id");
            $stmt->bindParam(':req_id', $req_id);
            $stmt->execute();
            $count_chk_0 = $stmt->rowCount();


            if ($count_chk_0 === 0) {

                $count_chk_res = false;
            }

            else {

                $count_chk_res = true;
            }

            return $count_chk_res;

        }


        function fn_update_state_0 () {

            global $dbh, $req_id;

            $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
            $update_state1 = '0';
            $stmt->bindParam(':update_state1', $update_state1);
            $stmt->bindParam(':req_id', $req_id);
            $stmt->execute();

            $arr = array('msg' => '', 'error' => "start-stopped");
            $jsn = json_encode($arr);
            print_r($jsn);


        }



        function fn_update_state_1_ps_shell_exec () {

            global $dbh, $req_id, $psScriptPath, $state_id, $vm_name, $vm_ds, $vol_name, $snap_name, $snap_date, $requestor_name, $requestor_email, $owner;


            $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
            $update_state1 = '1';
            $stmt->bindParam(':update_state1', $update_state1);
            $stmt->bindParam(':req_id', $req_id);

            $result_stmt = $stmt->execute();

            if (!$result_stmt) {

                $arr = array('msg' => '', 'error' => "update-error_exit");
                $jsn = json_encode($arr);
                print_r($jsn);
                exit(1);
            }


            else {


                $psScriptPath = "C:\\sc_v2\\restore_bmw_v2_1.ps1";

                $query = shell_exec("powershell -command $psScriptPath -req_id '$req_id' -state_id '$state_id' -vm_name '$vm_name' -vm_ds '$vm_ds' -vol_name '$vol_name' -snap_name '$snap_name' -snap_date '$snap_date' -requestor_name '$requestor_name' -requestor_email '$requestor_email' -owner '$owner'< NUL");

                $file_log1 = "c:\\sc_v2\\logs\\restore_debug.log";

                $datestr0 = date("d_m_Y_H_i_s");

                $filename = $file_log1;
                $filename2 = "C:\\sc_v2\\logs\\old\\$datestr0.log";
                rename($filename, $filename2);

                $filename3 = "C:\\sc_v2\\logs\\old\\$datestr0.debug.log";

                file_put_contents($filename3, $query);

                $arr = array('msg' => '$req_id', 'error' => "");
                $jsn = json_encode($arr);
                print_r($jsn);

            }


        }



        function fn_select_state_1_3 () {

            global $dbh, $req_id;

            $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=1 or state=3 LIMIT 1");
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


        function fn_update_state_3 () {

            global $dbh, $req_id;

            $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
            $update_state1 = '3';
            $stmt->bindParam(':update_state1', $update_state1);
            $stmt->bindParam(':req_id', $req_id);
            $stmt->execute();

            $arr = array('msg' => '',  'error' => "start-error3");
            $jsn = json_encode($arr);
            print_r($jsn);

        }



        function fn_select_state_4 () {

            global $dbh, $req_id;

            $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=4 and id = :req_id");
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



        function fn_update_state_4 () {
            global $dbh, $req_id;

            $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
            $update_state1 = '4';
            $stmt->bindParam(':update_state1', $update_state1);
            $stmt->bindParam(':req_id', $req_id);
            $stmt->execute();

            $arr = array('msg' => '', 'error' => "start-suspended");
            $jsn = json_encode($arr);
            print_r($jsn);

        }


        if ($req_id && $state_id && $vm_name && $vm_ds && $vol_name && $snap_name && $snap_date && $requestor_name && $requestor_email && $owner) {


            $output_fn_select_state_0 = fn_select_state_0();

            if ($output_fn_select_state_0) {


                $output_fn_select_state_1_3 = fn_select_state_1_3();

                if ($output_fn_select_state_1_3) {


                    fn_update_state_4();


                    $i = 0;

                    do {

                        $i++;

                        sleep(30);

                        $output_fn_select_state_1_3 = fn_select_state_1_3();

                        if (!$output_fn_select_state_1_3) {


                            $output_fn_select_state_4 = fn_select_state_4();

                            if ($output_fn_select_state_4) {


                                fn_update_state_1_ps_shell_exec();


                            }


                        }


                    } while ($output_fn_select_state_1_3 and $i <= 40);


                    if ($i === 40) {
                        fn_update_state_0();
                    }

                }


                else {


                    $output_fn_select_state_1_3 = fn_select_state_1_3();

                    if (!$output_fn_select_state_1_3) {


                        $output_fn_select_state_0 = fn_select_state_0();

                        if ($output_fn_select_state_0) {

                            fn_update_state_1_ps_shell_exec();

                        }

                    }



                    else {

                        fn_update_state_3();
                    }

                }


            }


            else {


                fn_update_state_3();
            }


        }

        else {


            fn_update_state_3();

        }


    }


    else {


        fn_update_state_3();
    }

}


?>