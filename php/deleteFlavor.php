<?php
/**
 * 删除口味
 */

$code=0;
$data=[];
$msg=["删除失败","删除成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];

// $id=2;


$sql = "delete from dish_flavor where df_id = ?;";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>