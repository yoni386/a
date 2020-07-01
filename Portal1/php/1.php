<?php
include("configPDO.php");

$req_id = 646;

function fn_select_state_0 (){

    global $dbh,$req_id;


//global $req_id;

    $stmt = $dbh->prepare("SELECT state FROM table_vm_restore_form1 where state=0 and id = :req_id");
    $stmt->bindParam(':req_id', $req_id);
    $stmt->execute();
    $count_chk_0 = $stmt->rowCount();

    var_dump($count_chk_0);

    if ($count_chk_0 === 0) {

        $res1 = false;
    } else {

        $res1 = true;
    }

    return $res1;

}

$is_blocked = fn_select_state_0();

var_dump($is_blocked);

//function fn_select_state_0 () {

//$req_id = 638;
//global $dbh;
//
//$stmt = $dbh->prepare("SELECT count(*) FROM table_vm_restore_form1 where state=2 and id = :req_id");
//$stmt->bindParam(':req_id', $req_id);
////    $result_stmt = $stmt->execute();
//
//$result_stmt = $stmt->fetch();
//var_dump($result_stmt);

//    $select_result = $result_stmt->fetch();

//    if ($result_stmt===0) {
//
//        $res='false';
//    }
//
//    else {
//§
//        $res='true';
//    }
//
////    return $res;
//
//
//print_r($res);

//}

//$is_blocked = fn_select_state_0();

//print_r($is_blocked);

//echo ($is_blocked);

//if ($is_blocked) {
//
//    print_r('true');
//
//}
//
//
//else {
//
//    print_r('false');
//
//}




?>