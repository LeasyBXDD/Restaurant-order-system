<?php
/**
 * 添加口味
 */

$code=0;
$data=[];
$msg=["添加失败","添加成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
$name=$_GET["name"];
$val=$_GET["val"];

// $id=2;
// $name='辣度';
// $val='["不辣","微辣","中辣","重辣"]';

$sql = "insert into dish_flavor values (NULL,?,?,?);";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"iss",$id,$name,$val);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>