<?php
/**
 * Created by PhpStorm.
 * User: yybutter
 * Date: 7/6/15
 * Time: 11:21 下午
 */
require_once "./DbConfig.php";
header('Content-type: application/json');

$DB_HostName = DbConfig::Host;
$DB_Name = DbConfig::Database;
$DB_User = DbConfig::User;
$DB_Pass = DbConfig::Password;
$DB_Table1 = "NoteTable";
$DB_Table2 = "MindTable";
$error_msg = "cannot create a new mind node";
$success_msg = "OK";

if($_POST) {
    if(isset ($_POST["UserID"])) {
        $UserID = $_POST['UserID'];
        $NoteID = $_POST['NoteID'];
        $Topic = $_POST['Topic'];
        $Parent_Topic = $_POST['Parent_Topic'];


        $con = mysql_connect($DB_HostName,$DB_User,$DB_Pass) or die(mysql_error());
        mysql_select_db($DB_Name,$con) or die(mysql_error());

        $sql = "SELECT NoteID FROM $DB_Table1 WHERE Topic='$Parent_Topic'";
        $res = mysql_query($sql,$con) or die(mysql_error());
        $result1 = mysql_query($sql);
        $result2 = mysql_fetch_array($result1,MYSQL_NUM);
        if ($res) {

            $sql2 = "INSERT into $DB_Table2 (parentId,userID,MindTitle) VALUES ('$result2[0]','$UserID','$Topic');";
            $resInset  = mysql_query($sql2,$con) or die(mysql_error());

            if ($resInset) {
                //but this should be done with roll back $sql, have not been done here.
                echo '{"success":1,"success_message":"'.$success_msg.'"}';


            }else{
                echo '{"success":0,"error_message":"'.$error_msg.'"}';
            }
        }else{
            echo '{"success":0,"error_message":"'.$error_msg.'"}';
        }
        mysql_close($con);

    } else {
        echo '{"success":0,"error_message":"'.$error_msg.'"}';
    }
}else {
    echo '{"success":0,"error_message":"'.$error_msg.'"}';
}

?>