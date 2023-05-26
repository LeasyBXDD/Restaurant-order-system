<?php
/**
 * 管理员登录验证
 */

$code=0;
$data=[];
$msg=["管理员不存在","登录成功","密码错误"];

include('conn.php');
include("functions.php");
$adminName = $_GET["admin_name"];
$adminPwd = $_GET["admin_pwd"];

// $adminName="root";
// $adminPwd="123456";

$adminPwd=md5($adminPwd);

// echo $userPwd;

$sql = "select admin_pwd from admin where admin_id = ?;";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"s",$adminName);
mysqli_stmt_execute($stmt);

$rs = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($rs)) {
    $admin_pwd=$row["admin_pwd"];
}
// echo $user_pwd;

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else if($userPwd==$user_pwd){
    $code=1;
}
else{
    $code=2;
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>