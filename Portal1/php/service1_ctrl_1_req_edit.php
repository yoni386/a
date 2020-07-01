<?php
require("configPDO.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_GET["update_entry_data"])) {

        $update_entry_data = json_decode($_GET["update_entry_data"]);

        $id = json_decode($_GET["id"]);

        $stmt = $dbh->prepare(

            "UPDATE table_vm_restore_form1

         SET

             vm_name             = :vm_name,
             vm_ds               = :vm_ds,
             vol_name           =  :vol_name,
             snap_name           = :snap_name,
             snap_date           = :snap_date,
             requestor_name      = :requestor_name,
             requestor_email     = :requestor_email,
             owner               = :owner

         WHERE id                = :id");



        $vm_name         = $update_entry_data->vm_name_input->{'vm_name'};
        $vm_ds           = $update_entry_data->vm_name_input->{'vm_ds'};
        $vol_name        = $update_entry_data->snap_input->{'vol_name'};
        $snap_name       = $update_entry_data->snap_input->{'snap_name'};
        $snap_date       = $update_entry_data->snap_input->{'snap_date'};
        $requestor_name  = $update_entry_data->requestor_restore_input->{'requestor_name'};
        $requestor_email = $update_entry_data->requestor_restore_input->{'requestor_email'};
        $owner           = $update_entry_data->owner_restore_input;

        $stmt->bindParam(':id'              , $id);
        $stmt->bindParam(':vm_name'         , $vm_name);
        $stmt->bindParam(':vm_ds'           , $vm_ds);
        $stmt->bindParam(':vol_name'        , $vol_name);
        $stmt->bindParam(':snap_name'       , $snap_name);
        $stmt->bindParam(':snap_date'       , $snap_date);
        $stmt->bindParam(':requestor_name'  , $requestor_name);
        $stmt->bindParam(':requestor_email' , $requestor_email);
        $stmt->bindParam(':owner'           , $owner);


        if ($id && $vm_name && $vm_ds && $vol_name && $snap_name && $snap_date && $requestor_name && $requestor_email && $owner) {


            $result_stmt = $stmt->execute();

            if ($result_stmt) {

                $arr = array('msg' => $id, 'error' => "");
                $jsn = json_encode($arr);
                print_r($jsn);
            }


            else {
                $arr = array('msg' => '', 'error' => "insert-error1");
                $jsn = json_encode($arr);
                print_r($jsn);
            }


        }

    }

    else {
        $arr = array('msg' => '',  'error' => "insert-error2");
        $jsn = json_encode($arr);
        print_r($jsn);
    }

}


?>
