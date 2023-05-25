<?php
/**
 * 查询购物车内相同物品是否存在
 */

$code=0;
$data=[];
$msg=["不存在","存在"];

include('conn.php');
include("functions.php");

$dish_id=$_GET["dish_id"];
$user_id=$_GET["user_id"];
$dish_flavor=$_GET["dish_falvor"];

// $dish_id=1;
// $user_id=1;
// $dish_flavor='';

$sql="select * from shopping_cart where dish_id = ? and user_id = ? and dish_flavor = ?;";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"iis",$dish_id,$user_id,$dish_flavor);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($rs)) {
    $code=1;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>