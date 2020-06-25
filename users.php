<?php
function getConnect(){
    try{
        $connect = new PDO("mysql:host=localhost;dbname=duan1;charset=utf8",
                        "root", "");
        return $connect;
    }catch(Exception $ex){
        echo "khong ket noi duoc csdl";
        die;
    }
}
function executeQuery($sqlQuery, $getAll = false){
    $conn = getConnect();
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    if($getAll){
        $result = $stmt->fetchAll();
    }else{
        $result = $stmt->fetch();
    }
    return $result;
}
function dd($data)  
{
    echo '<pre>';
  var_dump($data);
  die; 
}
