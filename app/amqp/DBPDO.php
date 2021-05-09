<?php
// 连接数据库
class DBPDO{
private static $dsn = 'mysql:host=localhost;dbname=laravel';
 private static $db_user="root";
 private static $db_pwd="root";
     public static function getConnection() {
        try {
            $pdo = new PDO(self::$dsn,self::$db_user,self::$db_pwd);
            $pdo->setAttribute(PDO::ATTR_PERSISTENT, true); // 设置数据库连接为持久连接
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 设置抛出错误
            // $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, true); // 设置当字符串为空转换为 SQL 的 NULL
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);//是否转换成string
            $pdo->query('SET NAMES utf8'); // 设置数据库编码
        }catch (PDOException $e) {
            exit('数据库连接错误，错误信息：'. $e->getMessage());
        }
        return $pdo;
    }
    public static function insert($sql,$arr=[]){
        $conn=self::getConnection();
        $insert=$conn->prepare($sql);
        for ($i=0;$i<count($arr);$i++){
            $insert->bindParam($i+1,$arr[$i]);
        }
        return $insert->execute();
    }
    public static function delete($sql,$arr=[]){
        $conn=self::getConnection();
        $del=$conn->prepare($sql);
        for ($i=0;$i<count($arr);$i++){
            $del->bindParam($i+1,$arr[$i]);
        }
        return $del->execute();
    }
    public static function update($sql,$arr=[]){
        $conn=self::getConnection();
        $up=$conn->prepare($sql);
        for ($i=0;$i<count($arr);$i++){
            $up->bindParam($i+1,$arr[$i]);
        }
        return $up->execute();
    }
    public static function select($sql,$arr=[]){
        $conn=self::getConnection();
       $res=$conn->prepare($sql);
        for ($i=0;$i<count($arr);$i++){
            $res->bindParam($i+1,$arr[$i]);
        }
        $res->execute();
         return $res->fetchAll();
    }
}
?>
