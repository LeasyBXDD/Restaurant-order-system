<?php
/**
 * 获取各个营养今日重量
 */

$code=0;
$data=[];
$msg=["查询失败","查询成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
$y=$_GET["year"];
$m=$_GET["month"];
$d=$_GET["day"];
// $id=1;

// $y=date("Y");
// $m=date("m");
// $d=date("d");

$sql = "select d.ntt_name as name,sum(b.amount) as weight from nutrition d,dish c, orders a,order_detail b where b.dish_id=c.dish_id and a.order_id = b.order_id and year(a.order_time) = ? and month(a.order_time) = ? and day(a.order_time) = ? and d.ntt_id = c.dish_nutrition_id and a.user_id = ? and a.order_status = 5 group by d.ntt_name;";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"sssi",$y,$m,$d,$id);
mysqli_stmt_execute($stmt);

$rs = mysqli_stmt_get_result($stmt);
$i=0;
while ($row = mysqli_fetch_assoc($rs)) {
    $data[$i]["name"]=$row["name"];
    $data[$i]["weight"]=$row["weight"];
    $i++;
}

if(mysqli_num_rows($rs)>0) $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>