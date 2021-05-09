<?php

class Db
{
    private $HOST = "bdm257480232.my3w.com";   //主机名
    private $USER = "bdm257480232";        //账号
    private $PASS = "ding6380905";       //密码
    private $DBNAME = "bdm257480232_db";    //数据库名

    public function connect()
    {
        $link = @mysqli_connect($this->HOST, $this->USER, $this->PASS, $this->DBNAME) or die("连接失败" . mysqli_connect_error());
        mysqli_query($link,$sql="set names utf8");
        return $link;
    }

    public function fetchOne($link, $sql)
    {
        $result_type = MYSQLI_ASSOC;
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_array($result, $result_type);
        mysqli_free_result($result);
        return $row;
    }

    public function fetchAll($link, $sql)
    {
        $arr = array();
        $result_type = MYSQLI_ASSOC;
        $result = mysqli_query($link, $sql);
        while (@$rows = mysqli_fetch_array($result, $result_type)) {
            $arr[] = $rows;
        }
        mysqli_free_result($result);
        return $arr;
    }

    public function all_rows($link, $sql)
    {
        $result = mysqli_query($link, $sql);
        $all_rows = mysqli_num_rows($result);
        return $all_rows;
    }

    public function insert($link, $sql)
    {
        mysqli_query($link, $sql);
        return mysqli_insert_id($link);
    }
}

?>