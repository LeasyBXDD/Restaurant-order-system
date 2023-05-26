<?php
/**
 * 用户修改信息
 */

$code=0;
$data=[];
$msg=["用户信息修改失败","用户信息修改成功"];

include('conn.php');
include("functions.php");

$userName = "";
$userSex = "";
$userAge = 0;
$userAvatar = "";

$userId = $_GET["id"];
$userName = $_GET["name"];
$userSex = $_GET["sex"];
$userAge = $_GET["age"];
$userAvatar = $_GET["avatar"];

// $userId=1;
// $userName = "fxy";
// $userSex = "男生";
// $userAge = 20;
// $userAvatar = "";


$sql = "update user set user_name=?,user_sex=?,user_age=?,user_avatar=? where user_id=?;";
// echo $sql;
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"ssisi",$userName,$userSex,$userAge,$userAvatar,$userId);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt)<=0){
    $code=0;
}
else $code=1;

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code,$data,$msg);
?>