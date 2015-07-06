<?php

require "./MindMapFactory.php";

$nodeId = $_POST["NodeId"];
if ($nodeId == null) {
    echo "NodeId not found!";
    return;
}

// For debug
echo json_encode(queryMindMapByNodeId($nodeId), true);

