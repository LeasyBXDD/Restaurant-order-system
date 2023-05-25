<?php
/**
 * 获取分类
 */

$code=0;
$data=[];
$msg=["获取失败","获取成功"];

include('conn.php');
include("functions.php");

$sql = "select * from category;";
$rs=mysqli_query($conn,$sql);
$i=0;
while($row=mysqli_fetch_array($rs)){
    $data[$i]["id"]=$row["ctg_id"];
    $data[$i]["name"]=$row["ctg_name"];
    $i++;
}

if(mysqli_num_rows($rs)>0) $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>