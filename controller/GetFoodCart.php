<?php
    require_once ("../db/DbManage.php");
    require_once ("../service/FoodCartService.php");
    getFoodCart();

    function getFoodCart(){
        $dbManage = new DbManage();
        $foodCartService = new FoodCartService();

        $num = $_GET["num"];

        $orderId = $foodCartService->getOrderId($num);

        if($orderId != -1){
            $sqlTxt = "SELECT f.FoodId, f.FoodType, f.FoodPictureString, f.Price, fc.Quantity, f.FoodName" .
                        " FROM foodcart fc" .
                        " INNER JOIN foods f ON f.FoodId = fc.FoodId" .
                        " WHERE OrderId = " . $orderId;

            $result = $dbManage->executeSqlTxt($sqlTxt);

            $cart = array();

            while ($row = mysqli_fetch_array($result)){
                $item["ch_dishno"] = intval($row["FoodId"]);
                $item["ch_typeno"] = $row["FoodType"];
//                $item["img"] = "cloud://cloud1-0gsewidkc4621771.636c-cloud1-0gsewidkc4621771-1311858708/图片/" . $row["FoodPictureString"];
                $item["img"] = "../../../images/database.png";
                $item["num_m_price1"] = $row["Price"];
                $item["num_price1"] = $row["Price"];
                $item["quantity"] = intval($row["Quantity"]);
                $item["vch_dishname"] = $row["FoodName"];
                array_push($cart, $item);
            }

            echo json_encode($cart);
        }else{
            $res["backInfo"] = "0";
            echo json_encode($res);
        }


    }