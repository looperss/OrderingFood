<?php
require_once ("../db/DbManage.php");

class FoodCartService
{
    public function getOrderId($num){
        $dbManage = new DbManage();

        $sql = "SELECT * FROM orders WHERE OrderId = (SELECT MAX(OrderId) FROM orders WHERE" .
            " num = " . $num .
            " AND state != 4)";

        $result = mysqli_fetch_array($dbManage->executeSqlTxt($sql));

        $state = $result["state"];

        if($state == 2 || $state == 3){
            return $result["OrderId"];
        }else{
            return -1;
        }
    }

    public function getFoodCartById($FoodId, $OrderId){
        $dbManage = new DbManage();

        $sql = "SELECT COUNT(*) count FROM foodcart" .
                " WHERE FoodId = " . $FoodId;

        $result = mysqli_fetch_array($dbManage->executeSqlTxt($sql));

        $count = $result["count"];

        return $count;
    }

    public function getFoodCartById2($FoodId, $OrderId){
        $dbManage = new DbManage();

        $sql = "SELECT COUNT(*) count FROM foodcart" .
            " WHERE FoodId = " . $FoodId . " AND OrderId = " . $OrderId . " AND Quantity > 0";

        $result = mysqli_fetch_array($dbManage->executeSqlTxt($sql));

        $count = $result["count"];

        return $count;
    }
}