<?php
/**
 * Created by PhpStorm.
 * User: yybutter
 * Date: 7/7/15
 * Time: 2:21 下午
 */
require_once "./DbConfig.php";
header('Content-type: application/json');

$DB_HostName = DbConfig::Host; //localhost
$DB_Name = DbConfig::Database;
$DB_User = DbConfig::User;
$DB_Pass = DbConfig::Password;
$DB_Table = "MindTable";
$error_msg = "no note found";
$success_msg = "OK";
//

if($_POST) {
    if(isset ($_POST["NoteID"])) {
        $MindID = $_POST['NoteID'];

        $con = mysql_connect($DB_HostName,$DB_User,$DB_Pass) or die(mysql_error());
        mysql_select_db($DB_Name,$con) or die(mysql_error());

        $sql = "UPDATE $DB_Table SET deleted='1' WHERE nodeId='$NoteID'";
        $res = mysql_query($sql,$con) or die(mysql_error());

        mysql_close($con);
        if ($res) {
            echo '{"success":1,"success_message":"'.$success_msg.'"}';
        }else{
            echo '{"success":1,"error_message":"'.$error_msg.'"}';
        }// end else

    } else {
        echo '{"success":0,"error_message":"'.$error_msg.'"}';
    }
}else {
    echo '{"success":0,"error_message":"'.$error_msg.'"}';
}

?>