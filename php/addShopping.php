<?php
/**
 * 添加到购物车
 */

$code=0;
$data=[];
$msg=["添加失败","添加成功"];

include('conn.php');
include("functions.php");

$dish_id=$_GET["dish_id"];
$user_id=$_GET["user_id"];
$name=$_GET["name"];
$img=$_GET["img"];
$dish_flavor=$_GET["dish_flavor"];
$amount=$_GET["amount"];

// $user_id=1;
// $name='';
// $img='';
// $dish_id=1;
// $dish_flavor="不辣";
// $amount=80;

$sql = "insert into shopping_cart values (NULL,?,?,?,?,?,1,?);";
    // // echo $sql;
    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"ssiisi",$name,$img,$user_id,$dish_id,$dish_flavor,$amount);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt)<=0){
        $code=0;
    }
    else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>