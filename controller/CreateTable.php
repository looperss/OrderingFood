<?php
    require_once ("../db/DbManage.php");
    createTable();

    function createTable(){
        $num = $_GET["num"];
        $person = $_GET["person"];

        $dbManage = new DbManage();

        $sqlTxt = "INSERT INTO orders" .
            " SET OrderId = NUll," .
            " num = " . $num .
            " , person = " . $person .
            " , state = 1" .
            " ,createDate = '" . date("Y-m-d H:i:s") . "'";


        $result1 = $dbManage->executeSqlTxt($sqlTxt);

        $sqlTxt = "UPDATE tablesinfo" .
            " SET state = 1" .
            " WHERE TableNum = " . $num;

        $result2 = $dbManage->executeSqlTxt($sqlTxt);
    }
