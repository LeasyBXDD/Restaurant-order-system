<?php
/**
 * 添加订单
 */

$code=0;
$data=[];
$msg=["添加失败","添加成功"];

include('conn.php');
include("functions.php");
$remark="";

$id=$_GET["id"];
$time=date("YmdHis").$id.rand(100,999);
$order_time=date("Y-m-d H:i:s");
$amount=$_GET["amount"];
$remark=$_GET["remark"];
$number=$_GET["number"];

// $id=1;
// $time=date("YmdHis").$id.rand(100,999);
// $address_book_id=1;
// $order_time=date("Y-m-d H:i:s");
// $amount=100;
// $remark='不要辣';

$sql = "insert into orders values (NULL,?,1,?,?,NULL,?,?,?);";
// // echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"sisisi",$time,$id,$order_time,$amount,$remark,$number);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>