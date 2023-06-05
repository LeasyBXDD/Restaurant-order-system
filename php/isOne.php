<?php
/**
 * 判断购物车中数量是否为1
 */

$code=0;
$data=[];
$msg=["数量不为1","数量为1"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];

// $id=1;

$sql="select number from shopping_cart where id = ?;";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
$rs = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($rs)) {
    if($row["number"]==1)$code=1;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>