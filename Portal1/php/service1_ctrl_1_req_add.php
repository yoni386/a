<?php
require("configPDO.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_GET["insert_entry_data"])) {

        $insert_entry_data = json_decode($_GET["insert_entry_data"]);

        $stmt = $dbh->prepare("INSERT INTO table_vm_restore_form1 (vm_name, vm_ds, vol_name, snap_name, snap_date, requestor_name, requestor_email , owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $vm_name);
        $stmt->bindParam(2, $vm_ds);
        $stmt->bindParam(3, $vol_name);
        $stmt->bindParam(4, $snap_name);
        $stmt->bindParam(5, $snap_date);
        $stmt->bindParam(6, $requestor_name);
        $stmt->bindParam(7, $requestor_email);
        $stmt->bindParam(8, $owner);

        $vm_name         = $insert_entry_data->vm_name_input->{'vm_name'};
        $vm_ds           = $insert_entry_data->vm_name_input->{'vm_ds'};
        $vol_name        = $insert_entry_data->snap_input->{'vol_name'};
        $snap_name       = $insert_entry_data->snap_input->{'snap_name'};
        $snap_date       = $insert_entry_data->snap_input->{'snap_date'};
        $requestor_name  = $insert_entry_data->requestor_restore_input->{'requestor_name'};
        $requestor_email = $insert_entry_data->requestor_restore_input->{'requestor_email'};
        $owner           = $insert_entry_data->owner_restore_input;

        if ($vm_name && $vm_ds && $vol_name && $snap_name && $snap_date && $requestor_name && $requestor_email && $owner) {

            $stmt->execute();

            $id = $dbh->lastInsertId();

            if ($id) {

                $arr = array('msg' => "$id", 'error' => '');
                $jsn = json_encode($arr);
                print_r($jsn);
            } else {
                $arr = array('msg' => '', 'error' => "insert-error");
                $jsn = json_encode($arr);
                print_r($jsn);
            }


        }

    }

    else {
        $arr = array('msg' => '',  'error' => "insert-error");
        $jsn = json_encode($arr);
        print_r($jsn);
    }

}


?>
