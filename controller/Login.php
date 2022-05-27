<?php
    require_once ("../db/DbManage.php");
    require_once ("../service/LoginService.php");
    login();

    function login(){
        $loginService = new LoginService();

        $num = $_GET["num"];

        //先获取该桌是否已被使用，返回0表示未被使用，1表示正在被使用
        $tableState = $loginService->useJudge($num);
        if($tableState == 0){

            $res["backInfo"] = "0";
            echo json_encode($res);
        }else if($tableState == 1){
            $res["backInfo"] = "1";
            echo json_encode($res);
        }else if($tableState == -1){
            //桌子已被废弃
            $res["backInfo"] = "-1";
            echo json_encode($res);
        }else{
            //出错
            $res["backInfo"] = "-2";
            echo json_encode($res);
        }
    }
