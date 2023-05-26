<?php
/**
 * 按照用户id获取购物车
 */

$code=0;
$data=[];
$msg=["获取失败","获取成功"];

include('conn.php');
include("functions.php");

// $id=$_GET["id"];
$id=1;

$sql = "select * from shopping_cart where user_id = ? order by dish_id asc;";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);

$rs = mysqli_stmt_get_result($stmt);
$i=0;
while ($row = mysqli_fetch_assoc($rs)) {
    $data[$i]["name"]=$row["name"];
    $data[$i]["img"]=$row["image"];
    $data[$i]["dish_flavor"]=$row["dish_flavor"];
    $data[$i]["number"]=$row["number"];
    $data[$i]["amount"]=$row["amount"];
    $i++;
}

if(mysqli_num_rows($rs)>0) $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>