<?php
require_once ("../db/DbManage.php");

class LoginService
{
    public function useJudge($num){
        $dbManage = new DbManage();

        $sqlTxt = "SELECT * FROM tablesinfo" .
                    " WHERE TableNum = " . $num;

        $result = mysqli_fetch_array($dbManage->executeSqlTxt($sqlTxt));

//        echo $result['actFlag'] . "|" . $result['state'];

        if($result['actFlag'] == 1){
            if($result['state'] == 1){
                //表示该桌子正在被使用
                return 1;
            }
            //表示该桌子未被使用
            return 0;
        }else{
            //表示该桌子已被废弃
            return -1;
        }
    }
}