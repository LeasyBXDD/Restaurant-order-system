<?php
/**
 * 修改餐品分类
 */

$code=0;
$data=[];
$msg=["修改失败","修改成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
$name=$_GET["name"];

// $id=5;
// $name='杭帮菜';

$sql = "update category set ctg_name = ? where ctg_id = ?;";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"si",$name,$id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>