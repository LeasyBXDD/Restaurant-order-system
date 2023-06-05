<?php
/**
 * 添加订单详情
 */

$code=0;
$data=[];
$msg=["添加失败","添加成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
$dish_id=$_GET["dish_id"];
$dish_flavor=$_GET["dish_flavor"];
$number=$_GET["number"];
$amount=$_GET["amount"];

// $id=1;
// $dish_id=1;
// $dish_flavor="不辣";
// $number=1;
// $amount=80;

$sql = "insert into order_detail values (NULL,?,?,?,?,?);";
// // echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"iisii",$id,$dish_id,$dish_flavor,$number,$amount);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>