<?php
/**
 * 按照用户id获取历史订单
 */

$code=0;
$data=[];
$msg=["获取失败","获取成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
// $id=1;

$sql = "select u.user_name,u.user_phone,o.number,o.order_number,o.order_status,o.order_time,o.checkout_time,o.amount,o.remark from orders o,user u where  u.user_id=o.user_id and o.user_id=? order by o.order_time asc;";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);

$rs = mysqli_stmt_get_result($stmt);
$i=0;
while ($row = mysqli_fetch_assoc($rs)) {
    $data[$i]["order_number"]=$row["df_name"];
    $data[$i]["status"]=$row["order_status"];
    $data[$i]["phone"]=$row["user_phone"];
    $data[$i]["order_time"]=$row["order_time"];
    $data[$i]["checkout_time"]=$row["checkout_time"];
    $data[$i]["amount"]=$row["amount"];
    $data[$i]["remark"]=$row["remark"];
    $data[$i]["name"]=$row["user_name"];
    $data[$i]["number"]=$row["number"];
    $i++;
}

if(mysqli_num_rows($rs)>0) $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>