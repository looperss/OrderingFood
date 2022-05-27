<?php
    header("Content-Type:text/html; charset=utf-8");
    require_once ("../db/DbManage.php");
    getFoods();

    function getFoods(){
        $dbManage = new DbManage();

        $sql = "SELECT * FROM foods";

        $result = $dbManage->executeSqlTxt($sql);

        $res = array();

        while($row = mysqli_fetch_array($result)){
            $item["quantity"] = 0;
            $item["num_price1"] = $row["Price"];
            $item["num_m_price1"] = $row["Price"];
//            $item["img"] = "cloud://cloud1-0gsewidkc4621771.636c-cloud1-0gsewidkc4621771-1311858708/图片/" . $row["FoodPictureString"];
            $item["img"] = "../../../images/database.png";
            $item["ch_typeno"] = $row["FoodType"];
            $item["ch_dishno"] = intval($row["FoodId"]);
            $item["vch_dishname"] = $row["FoodName"];

            array_push($res, $item);
        }

        echo json_encode($res);
    }