<?php
/**
 * 获取该餐品共销售了多少
 */

$code=0;
$data=[];
$msg=["获取失败","获取成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
// $id=1;

$sql = "select count(*) as number from order_detail where dish_id = ?;";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);

$rs = mysqli_stmt_get_result($stmt);
$i=0;
while ($row = mysqli_fetch_assoc($rs)) {
    $data[$i]["number"]=$row["number"];
    $i++;
}

if(mysqli_num_rows($rs)>0) $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>