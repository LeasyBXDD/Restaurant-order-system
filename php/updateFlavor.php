<?php
/**
 * 修改口味
 */

$code=0;
$data=[];
$msg=["修改失败","修改成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
$name=$_GET["name"];
$val=$_GET["val"];

// $id=1;
// $name='忌口';
// $val='["不要葱","不要蒜","不要香菜","不要辣"]';

$sql = "update dish_flavor set df_name = ?,df_value = ? where df_id = ?;";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"ssi",$name,$val,$id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>