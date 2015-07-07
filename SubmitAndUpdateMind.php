<?php
/**
 * Created by PhpStorm.
 * User: yybutter
 * Date: 7/7/15
 * Time: 1:53 下午
 */

require_once "./DbConfig.php";
header('Content-type: application/json');

$DB_HostName = DbConfig::Host; //localhost
$DB_Name = DbConfig::Database;
$DB_User = DbConfig::User;
$DB_Pass = DbConfig::Password;
$DB_Table = "MindTable";
$error_msg1 = "NO POST";
$error_msg2 = "cannot submit";
$error_msg3 = "cannot get all submit records";
$error_msg4 = "cannot update mind";
$success_msg = "OK";

if($_POST) {
    if(isset ($_POST["userID"])&& isset($_POST["mindID"])) {
        $MindID = $_POST['mindID'];
        $UserID = $_POST['userID'];
        $MindTitle = $_POST['mindTitle'];
        $createdDates = $_POST['createdDates'];
        $modifiedDates = $_POST['modifiedDates'];
        $dimendionsX = $_POST['dimendionsX'];
        $dimendionsY = $_POST['dimendionsY'];
        $autosave = $_POST['autosave'];
        $NodeId = $_POST['nodeId'];
        $parentId = $_POST['parentId'];
        $caption = $_POST['caption'];
        $style = $_POST['style'];
        $weight = $_POST['weight'];
        $decoration = $_POST['decoration'];
        $size = $_POST['size'];
        $textColor = $_POST['textColor'];
        $offsetX = $_POST['offsetX'];
        $offsetY = $_POST['offsetY'];
        $foldChildren = $_POST['foldChildren'];
        $branchColor = $_POST['branchColor'];

        $con = mysql_connect($DB_HostName,$DB_User,$DB_Pass) or die(mysql_error());
        mysql_select_db($DB_Name,$con) or die(mysql_error());

        $sqlUpdate = "UPDATE $DB_Table SET  mindTitle='$mindTitle', createdDates='$createdDates', modifiedDates='$modifiedDates', dimendionsX='$dimendionsX', dimendionsY='$dimendionsY',autosave = '$autosave',nodeId='$nodeId',parentId='$parentId',caption = '$caption',style='$style',weight='$weight',decoration='$decoration',size='$size',textColor='$textColor',offsetX='$offsetX',offsetY='$offsetY',foldChildren='$foldChildren',branchColor='$branchColor'WHERE mindID='$mindID'AND userID='$userID';";
        $resUpdate= mysql_query($sqlUpdate,$con) or die(mysql_error());
        if ($resUpdate) {

                //but this should be done with roll back $sql, have not been done here.
                echo '{"success":1,"success_message":"'.$success_msg2.'"}';
        }else{
            echo '{"success":0,"error_message":"'.$error_msg3.'"}';
        }
        mysql_close($con);

    } else {
        echo '{"success":0,"error_message":"'.$error_msg4.'"}';
    }
}else {
    echo '{"success":0,"error_message":"'.$error_msg1.'"}';
}

?>