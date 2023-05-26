<?php
/**
 * 添加餐品
 */

$code=0;
$data=[];
$msg=["添加失败","添加成功"];

include('conn.php');
include("functions.php");

$name=$_GET["name"];
$price=$_GET["price"];
$img=$_GET["img"];
$des=$_GET["des"];
$status=$_GET["status"];
$weight=$_GET["weight"];
$category_id=$_GET["category_id"];
$nutrition_id=$_GET["nutrition_id"];

// $name='';
// $price=0;
// $img='';
// $des='';
// $status=1;
// $weight=250;
// $category_id=1;
// $nutrition_id=1;

$sql = "insert into dish values (NULL,?,?,?,?,?,?,?,?);";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"siissiii",$name,$category_id,$price,$img,$des,$status,$weight,$nutrition_id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>