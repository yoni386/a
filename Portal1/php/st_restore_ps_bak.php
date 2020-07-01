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

            global $dbh;

            $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=2 and id = :req_id");
            $stmt->bindParam(':req_id', $req_id);
            $stmt->execute();
            $count_chk_0 = $stmt->rowCount();


            if ($count_chk_0 === 0) {

                $count_chk_0_res = 'false';
            }

            else {

                $count_chk_0_res = 'true';
            }

            return $count_chk_0_res;

        }

        $output_fn_select_state_0 = fn_select_state_0();


        if ($req_id && $state_id && $vm_name && $vm_ds && $vol_name && $snap_name && $snap_date && $requestor_name && $requestor_email && $owner) {

//
//            $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=0 and id = :req_id");
//            $stmt->bindParam(':req_id', $req_id);
//            $result_stmt = $stmt->execute();
//            $count_chk_0 = $stmt->rowCount();

            $output_fn_select_state_0 = fn_select_state_0();

            $is_blocked = select_state_0();


            if ($is_blocked) {


                $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=1 or state=3 LIMIT 1");
                $stmt->bindParam(':req_id', $req_id);
                $result_stmt = $stmt->execute();
                $count_chk_1 = $stmt->rowCount();

                if ($count_chk_1) {


                    $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
                    $update_state1 = '4';
                    $stmt->bindParam(':update_state1', $update_state1);
                    $stmt->bindParam(':req_id', $req_id);
                    $result_stmt = $stmt->execute();

                    $arr = array('msg' => '', 'error' => "start-suspended");
                    $jsn = json_encode($arr);
                    print_r($jsn);


                    $i = 0;

                    do {

                        $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=1 or state=3 LIMIT 1");
                        $result_stmt = $stmt->execute();
                        $count_chk_do = $stmt->rowCount();

                        $i++;

                        sleep(30);

                        if (!$count_chk_do) {

                            $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=4 and id = :req_id");
                            $stmt->bindParam(':req_id', $req_id);
                            $result_stmt = $stmt->execute();
                            $count_chk_do_1 = $stmt->rowCount();

                            if ($count_chk_do_1) {

                                $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
                                $update_state1 = '1';
                                $stmt->bindParam(':update_state1', $update_state1);
                                $stmt->bindParam(':req_id', $req_id);
                                $result_stmt = $stmt->execute();

                                $psScriptPath = "C:\\sc_v2\\restore_bmw_v2_1.ps1";
                                $query = shell_exec("powershell -command $psScriptPath -req_id '$req_id' -state_id '$state_id' -vm_name '$vm_name' -vm_ds '$vm_ds' -vol_name '$vol_name' -snap_name '$snap_name' -snap_date '$snap_date' -requestor_name '$requestor_name' -requestor_email '$requestor_email' -owner '$owner'< NUL");

                                $file_log1 = "c:\\sc_v2\\logs\\restore_debug.log";

                                $datestr0 = date("d_m_Y_H_i_s");

                                $filename = $file_log1;
                                $filename2 = "C:\\sc_v2\\logs\\old\\$datestr0.log";
                                rename($filename, $filename2);

                                $filename3 = "C:\\sc_v2\\logs\\old\\$datestr0.debug.log";

                                file_put_contents($filename3, $query);

                            }


                        }


                    } while ($count_chk_do and $i <= 5);


                    $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
                    $update_state1 = '0';
                    $stmt->bindParam(':update_state1', $update_state1);
                    $stmt->bindParam(':req_id', $req_id);
                    $result_stmt = $stmt->execute();

                    $arr = array('msg' => '', 'error' => "start-stopped");
                    $jsn = json_encode($arr);
                    print_r($jsn);


                }


                else {


                    $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=1 or state=3 LIMIT 1");
                    $result_stmt = $stmt->execute();
                    $count_chk_2 = $stmt->rowCount();

                    if (!$count_chk_2) {


                        $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=0 and id = :req_id");
                        $stmt->bindParam(':req_id', $req_id);
                        $result_stmt = $stmt->execute();
                        $count_chk_3 = $stmt->rowCount();


                        if ($count_chk_3) {

                            $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
                            $update_state1 = '1';
                            $stmt->bindParam(':update_state1', $update_state1);
                            $stmt->bindParam(':req_id', $req_id);
                            $result_stmt = $stmt->execute();

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



                    else {

                        $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
                        $update_state1 = '3';
                        $stmt->bindParam(':update_state1', $update_state1);
                        $stmt->bindParam(':req_id', $req_id);
                        $result_stmt = $stmt->execute();


                        $arr = array('msg' => '',  'error' => "start-error3");
                        $jsn = json_encode($arr);
                        print_r($jsn);
                    }

                }


            }


            else {

                $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
                $update_state1 = '3';
                $stmt->bindParam(':update_state1', $update_state1);
                $stmt->bindParam(':req_id', $req_id);
                $result_stmt = $stmt->execute();


                $arr = array('msg' => '',  'error' => "start-error4");
                $jsn = json_encode($arr);
                print_r($jsn);
            }


        }

        else {


            $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
            $update_state1 = '3';
            $stmt->bindParam(':update_state1', $update_state1);
            $stmt->bindParam(':req_id', $req_id);
            $result_stmt = $stmt->execute();


            $arr = array('msg' => '',  'error' => "start-error5");
            $jsn = json_encode($arr);
            print_r($jsn);

        }


    }


    else {

        $stmt = $dbh->prepare("UPDATE table_vm_restore_form1 SET state = :update_state1 WHERE id = :req_id");
        $update_state1 = '3';
        $stmt->bindParam(':update_state1', $update_state1);
        $stmt->bindParam(':req_id', $req_id);
        $result_stmt = $stmt->execute();


        $arr = array('msg' => '',  'error' => "start-error6");
        $jsn = json_encode($arr);
        print_r($jsn);
    }

}


?>