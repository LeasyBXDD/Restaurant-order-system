<?php
/**
 * 修改订单状态
 */

$code=0;
$data=[];
$msg=["修改失败","修改成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
$status=$_GET["status"];

// $id=1;
// $status=2;

$sql = "update orders set order_status = ? where order_id = ?;";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"ii",$status,$id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>