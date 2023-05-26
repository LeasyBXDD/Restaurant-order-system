<?php
/**
 * 获取菜单
 */

$code=0;
$data=[];
$msg=["获取失败","获取成功"];

include('conn.php');
include("functions.php");
$id = $_GET["id"];

// $id = 2;

$sql = "select d.dish_id, d.dish_name, d.dish_price, d.dish_image, d.dish_des, d.dish_status, d.dish_weight, n.ntt_name from dish d,nutrition n where d.dish_nutrition_id=n.ntt_id and d.dish_category_id=?;";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);

$rs = mysqli_stmt_get_result($stmt);
$i=0;
while ($row = mysqli_fetch_assoc($rs)) {
    $data[$i]["dish_id"]=$row["dish_id"];
    $data[$i]["dish_name"]=$row["dish_name"];
    $data[$i]["dish_price"]=$row["dish_price"];
    $data[$i]["dish_img"]=$row["dish_image"];
    $data[$i]["dish_des"]=$row["dish_des"];
    $data[$i]["dish_status"]=$row["dish_status"];
    $data[$i]["nutrition"]=$row["ntt_name"];
    $data[$i]["dish_weight"]=$row["dish_weight"];
    $i++;
}
// echo $user_pwd;

if(mysqli_stmt_affected_rows($stmt)>0)$code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>