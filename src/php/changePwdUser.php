<?php
/**
 * 用户修改密码
 */

$code=0;
$data=[];
$msg=["修改失败","修改成功"];

include('conn.php');
include("functions.php");

$id=$_GET["id"];
$pwd=$_GET["pwd"];

// $id=1;
// $pwd='123456';

$pwd=md5($pwd);

$sql = "update user set user_pwd=? where user_id = ?";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"si",$pwd,$id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>