<?php
/**
 * 用户修改信息
 */

$code=0;
$data=[];
$msg=["修改失败","修改成功"];

include('conn.php');
include("functions.php");

$number=$_GET["number"];
$amount=$_GET["amount"];
$dish_id=$_GET["dish_id"];
$user_id=$_GET["user_id"];
$dish_flavor=$_GET["dish_flavor"];

// $number=-1;
// $amount=20;
// $dish_id=1;
// $user_id=1;
// $dish_flavor='1';

$sql = "update shopping_cart set number = number + ?,amount = amount + ? where dish_id=? and user_id=? and dish_flavor=?;";
// // echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"iiiis",$number,$amount,$dish_id,$user_id,$dish_flavor);
mysqli_stmt_execute($stmt);
if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>