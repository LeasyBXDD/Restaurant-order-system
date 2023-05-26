<?php
/**
 * 添加餐品分类
 */

$code=0;
$data=[];
$msg=["添加失败","添加成功"];

include('conn.php');
include("functions.php");

$name=$_GET["name"];

// $name='推荐';

$sql = "insert into category values (NULL,?);";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"s",$name);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>