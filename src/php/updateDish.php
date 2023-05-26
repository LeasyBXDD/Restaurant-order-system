<?php
/**
 * 修改餐品
 */

$code=0;
$data=[];
$msg=["修改失败","修改成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
$name=$_GET["name"];
$price=$_GET["price"];
$img=$_GET["img"];
$des=$_GET["des"];
$status=$_GET["status"];
$weight=$_GET["weight"];
$category_id=$_GET["category_id"];
$nutrition_id=$_GET["nutrition_id"];

// $id=3;
// $name='';
// $price=0;
// $img='';
// $des='';
// $status=0;
// $weight=250;
// $category_id=1;
// $nutrition_id=1;

$sql = "update dish set dish_name=?,dish_price=?,dish_image=?,dish_des=?,dish_status=?,dish_weight=?,dish_category_id=?,dish_nutrition_id=? where dish_id = ?;";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"sissiiiii",$name,$price,$img,$des,$status,$weight,$category_id,$nutrition_id,$id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>