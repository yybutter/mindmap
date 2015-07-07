<?php
/**
 * Created by PhpStorm.
 * User: yybutter
 * Date: 7/5/15
 * Time: 3:48 下午
 */

require "./Bean/MindMap.php";
require "./Bean/Text.php";
require "./Bean/Node.php";
require "./Bean/Font.php";
require "./Bean/Offset.php";
require "./Bean/Dates.php";
require "./Bean/Dimensions.php";
require "./Bean/Root.php";

function queryMindMapByNodeId($nodeId) {

    // 建立数据库链接
    $mysqli = new mysqli("localhost", "root", "", "mindmap");
    // 根据nodeId查找对应的mindId作为根节点的mindId以及userId;
    $stmt = $mysqli->prepare("SELECT mindId, userId FROM MindTable WHERE nodeId = ?");
    $stmt->bind_param("s", $nodeId);
    $stmt->execute();
    $stmt->bind_result($rootMindId, $userId);
    $haveResult = $stmt->fetch();
    $stmt->close();
    // 未查询到用户Id
    if (!$haveResult) {
        $mysqli->close();
        return "nodeId not exists";
    }
    // 根据用户ID查询该用户所有的结点
    $stmt = $mysqli->prepare("SELECT mindID, mindIDAlias, parentId, userID, nodeId, mindTitle, createdDates, modifiedDates, dimendionsX, dimendionsY, autosave, caption, style, weight, decoration, size, textColor, offsetX, offsetY, foldChildren, branchColor FROM MindTable WHERE userId = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->bind_result($m_mindID, $m_mindIDAlias, $m_parentId, $m_userID, $m_nodeId, $m_mindTitle, $m_createdDates, $m_modifiedDates, $m_dimendionsX, $m_dimendionsY, $m_autosave, $m_caption, $m_style, $m_weight, $m_decoration, $m_size, $m_textColor, $m_offsetX, $m_offsetY, $m_foldChildren, $m_branchColor);
    // 保存查询结果
    $resultArray = array();
    // 保存parent指向children的数据结构
    $parentPointToChildrenArray = array();
    while($stmt->fetch()) {
        $resultArray[$m_mindID] = array($m_mindIDAlias, $m_parentId, $m_userID, $m_nodeId, $m_mindTitle, $m_createdDates, $m_modifiedDates, $m_dimendionsX, $m_dimendionsY, $m_autosave, $m_caption, $m_style, $m_weight, $m_decoration, $m_size, $m_textColor, $m_offsetX, $m_offsetY, $m_foldChildren, $m_branchColor);
        // 根据parentId获得childrenId数组
        $childrenIdArray = $parentPointToChildrenArray[$m_parentId];
        if ($childrenIdArray == null) {
            $childrenIdArray = array();
        }
        array_push($childrenIdArray, $m_mindID);
        $parentPointToChildrenArray[$m_parentId] = $childrenIdArray;
    }
    $stmt->close();
    $mysqli->close();

    // DEBUG
    print_r($resultArray);
    print_r($parentPointToChildrenArray);

    // 根据$resultArray和$parentPointToChildrenArray构造MindMap
    // 首先构造MindMap
    $rootNodeArray = $resultArray[$rootMindId];
    $mindMap = new MindMap();
    // TODO

    $mindMap = new MindMap();
    $mindMap->id = "95a5406f-23d0-4591-8848-99cc09b75348";
    $mindMap->title = "E-learning";

    $rootNode = new Node();
    $rootNode->id = "74c11e1e-969d-4e1d-98f6-18d95e313898";
    $rootNode->parentId = null;
    $text = new Text();
    $text->caption = "E-learning";
    $font = new Font();
    $font->style = "normal";
    $font->weight = "bold";
    $font->decoration = "none";
    $font->size = 20;
    $font->color = "#000000";
    $text->font = $font;
    $rootNode->text = $text;
    $offset = new Offset();
    $offset->x = 0;
    $offset->y = 0;
    $rootNode->offset = $offset;
    $rootNode->foldChildren = false;
    $rootNode->branchColor = "#000000";

    $node1 = new Node();
    $node1->id = "7206f79d-fcf9-4153-a9cd-4d7505b6ffec";
    $node1->parentId = $rootNode->id;
    $text = new Text();
    $text->caption = "bbb";
    $font = new Font();
    $font->style = "normal";
    $font->weight = "bold";
    $font->decoration = "none";
    $font->size = 15;
    $font->color = "#000000";
    $text->font = $font;
    $node1->text = $text;
    $offset = new Offset();
    $offset->x = 186;
    $offset->y = -186;
    $node1->offset = $offset;
    $node1->foldChildren = false;
    $node1->branchColor = "#000000";
    $node1->children = array();

    $rootNode->children = array($node1);

    $root = new Root();
    $root->root = $rootNode;

    $mindMap->mindmap = $root;
    $dates = new Dates();
    $dates->created = 1435160284601;
    $dates->modified = 1436024689726;
    $mindMap->dates = $dates;
    $dimensions = new Dimensions();
    $dimensions->x = 4000;
    $dimensions->y = 2000;
    $mindMap->dimensions = $dimensions;
    $mindMap->autosave = false;

    return $mindMap;

}