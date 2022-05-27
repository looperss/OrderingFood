<?php
    require_once ("../db/DbManage.php");
    require_once ("../service/FoodCartService.php");
    delAFood();

    function delAFood(){
        $dbManage = new DbManage();
        $foodCartService = new FoodCartService();

        $num = $_GET["num"];
        $FoodId = $_GET["FoodId"];

        $OrderId = $foodCartService->getOrderId($num);

        $count = $foodCartService->getFoodCartById2($FoodId, $OrderId);

        if($count == 1){
            $sql = "UPDATE foodcart" .
                " SET Quantity = Quantity - 1" .
                " WHERE FoodId = " . $FoodId . " AND OrderId = " . $OrderId;

            $dbManage->executeSqlTxt($sql);

            $res["backInfo"] = 1;
            echo json_encode($res);
        }else if($count == 0){
            $res["backInfo"] = 0;
            echo json_encode($res);
        }else if($count > 1){
            $res["backInfo"] = $count;
            echo json_encode($res);
        }else{
            $res["backInfo"] = -1;
            echo json_encode($res);
        }
    }
