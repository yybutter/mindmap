<?php


$mysqli = new mysqli("localhost", "root", "", "mindmap");

$sql1=
    " INSERT INTO MindTable(mindId, mindIDAlias, parentId, userID, nodeId, mindTitle, createdDates, modifiedDates, dimendionsX, dimendionsY, autosave, caption, style, weight, decoration, size, textColor, offsetX, offsetY, foldChildren, branchColor)
      VALUES (600, '95a5406f-23d0-4591-8848-99cc09b75348', -1, 1, 1, 'E-learning', NOW(), NOW(), 4000, 2000, false, 'E-learning', 'normal', 'bold', 'none', 20, '#000000', 0, 0, false, '#000000');
    ";

$sql2=
    " INSERT INTO MindTable(mindId, mindIDAlias, parentId, userID, nodeId, mindTitle, createdDates, modifiedDates, dimendionsX, dimendionsY, autosave, caption, style, weight, decoration, size, textColor, offsetX, offsetY, foldChildren, branchColor)
      VALUES (601, '74c11e1e-969d-4e1d-98f6-18d95e313898', 600, 1, 2, 'Chindren1', NOW(), NOW(), 4000, 2000, false, 'E-learning', 'normal', 'bold', 'none', 15, '#000000', 0, 0, false, '#000000');
    ";

if ($mysqli->query($sql1) && $mysqli->query($sql2)) {
    echo "success";
} else {
    echo "error";
}

$mysqli->close();