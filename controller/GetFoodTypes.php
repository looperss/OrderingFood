<?php
    header("Content-Type:text/html; charset=utf-8");
    require_once ("../db/DbManage.php");
    getFoodTypes();

    function getFoodTypes(){
        $dbManage = new DbManage();

        $sql = "SELECT * FROM foodstype";

        $result = $dbManage->executeSqlTxt($sql);

        $res = array();

        while($row = mysqli_fetch_array($result)){
            $item["vch_typename"] = $row["foodType"];
            $item["ch_typeno"] = $row["foodTypeId"];
            array_push($res, $item);
        }

        echo json_encode($res);
    }