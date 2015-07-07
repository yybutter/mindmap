<?php

$con = mysql_connect("localhost:3306","root","");

if (!$con) {
    die("Could not connect: " +  mysql_error());
    return;
}

mysql_select_db("mindmap", $con);

$sql=
    " INSERT INTO MindTable(mindIDAlias, parentId, userID, nodeId, mindTitle, createdDates, modifiedDates, dimendionsX, dimendionsY, autosave, caption, style, weight, decoration, size, textColor, offsetX, offsetY, foldChildren, branchColor)
      VALUES ('95a5406f-23d0-4591-8848-99cc09b75348', -1, 1, 1, 'E-learning', NOW(), NOW(), 4000, 2000, false, 'E-learning', 'normal', 'bold', 'none', 20, '#000000', 0, 0, false, '#000000');
    ";

if (!mysql_query($sql, $con)) {
    die('Error: '. mysql_error());
} else {
    echo "success";
}

mysql_close($con);