<?php
//функции для работы с базой данных

    function connectToDB(){
     $config = require 'core/configs/db.php';
     $link = @mysqli_connect($config['host'],$config['user'],$config['password'],$config['db_name']);
     if(!$link){
         //Инклюдом подключить красивый файлик с текстом
         echo "DataBase connect error:".mysqli_connect_error();
         die();
     }
     return $link;
    }

    function selectData ($sql) {
        $link=connectToDB();
        $res=mysqli_query($link,$sql);

        if(!$res){
            die(mysqli_error($link));
        }
        return $res;
    }

    function insertUpdateDelete($sql){
        $link=connectToDB();
        $res=mysqli_query($link,$sql);

        if(!$res){
            die(mysqli_error($link));
        }

        return mysqli_insert_id($link);
    }

    function getSaveData($str) {
        $link = connectToDB();
        //global $baseConfig['secretKey'];
        return mysqli_real_escape_string($link, $str);
    }

function findModelById($table, $id){
    $sgl="SELECT * FROM $table WHERE id=$id";
    return selectData($sgl);
}

function getAll($table){
    $sgl="SELECT * FROM $table";
    return mysqli_fetch_all(selectData($sgl), MYSQLI_ASSOC);
}