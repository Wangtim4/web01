<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB {
    protected $dsn ="mysql:host=localhost;charset=utf8;dbname=db01";
    protected $user = "root";
    protected $pw= '';
    protected $table;
    protected $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn,$this->user,$this->pw);
    }

    public function all(...$arg) {
        $sql = "select * from $this->table ";
        // 是否存在參數
        if(isset($arg[0])){
            // $arg[0]是否為陣列
            if(is_array($arg[0])){
                foreach($arg[0] as $key => $value) {
                    $tmp[]="`$key` = '$value'";
                }
                // where `id`='1' AND `room` = 'vip'
                $sql .= " WHERE" .join(" AND ", $tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function find($id) {
        $sql = "select * from $this->table ";
        // 判斷id是否為陣列
        if(is_array($id)){
            foreach($id as $key => $value) {
                $tmp[]="`$key` = '$value'";
            }
            // where `id`='1' AND `room` = 'vip'
            $sql .= " WHERE" .join(" AND ", $tmp);
        }else{
            $sql .= " WHERE `id` = '$id' ";
        }

        // echo $sql;
        // 只取一筆
        // fetch不須回傳資料 
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE from $this->table ";
        // 判斷id是否為陣列
        if(is_array($id)){
            foreach($id as $key => $value) {
                $tmp[]="`$key` = '$value'";
            }
            // where `id`='1' AND `room` = 'vip'
            $sql .= " WHERE" .join(" AND ", $tmp);
        }else{
            $sql .= " WHERE `id` = '$id' ";
        }

        // echo $sql;
        // exec($sql)不須回傳資料        
        return $this->pdo->exec($sql);
    }

    public function save($array) {
        
        if(isset($array['id'])){
            // 有ID做更新
           
            foreach($array as $key => $value) {
                if($key != 'id'){

                    $tmp[]="`$key` = '$value'";
                }
            }
            // where `id`='1' AND `room` = 'vip'
            $sql = "UPDATE $this->table SET ".join(' , ', $tmp)." WHERE `id` = '{$array['id']}'";
        }else{
            // 沒有ID做新增
            $sql="INSERT INTO  $this->table (`".join("`,`",array_keys($array))."`) values ('".join("','",$array)."')";
        }

        // echo $sql;
        // exec($sql)不須回傳資料        
        return $this->pdo->exec($sql);
    }

    public function math($math,$col,...$arg) {
        $sql = "select $math($col) from $this->table ";
        // 是否存在參數
        if(isset($arg[0])){
            // $arg[0]是否為陣列
            if(is_array($arg[0])){
                foreach($arg[0] as $key => $value) {
                    $tmp[]="`$key` = '$value'";
                }
                // where `id`='1' AND `room` = 'vip'
                $sql .= " WHERE" .join(" AND ", $tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }

    public function q($sql){
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}

function to($url) {
    header("location:".$url);
}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$Button = new DB('button');
$Total = new DB('total');
$Title = new DB('title');
// print_r($Button->all());
// print_r($Button->all(['id'=>1]));
// print_r($Button->all(" where `id` = '1' ","' limit 1'"));
// echo $Total->find(1)['total'];

?>