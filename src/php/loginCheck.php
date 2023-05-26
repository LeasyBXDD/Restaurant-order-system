<?php

/**
 * 登录验证
 */

$code = 0;
$data = [];
$msg = ["用户不存在", "登录成功", "密码错误"];

include('conn.php');
include("functions.php");
$userName = $_POST["phone"];
$userPwd = $_POST["pwd"];

// $userName="13958958107";
// $userPwd="123456";

$userPwd = md5($userPwd);

// echo $userPwd;

$sql = "select user_pwd from user where user_phone = ?;";
// echo $sql;
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userName);
mysqli_stmt_execute($stmt);

$rs = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_assoc($rs)) {
    $user_pwd = $row["user_pwd"];
}
// echo $user_pwd;

if (mysqli_stmt_affected_rows($stmt) <= 0) {
    $code = 0;
} else if ($userPwd == $user_pwd) {
    $code = 1;
} else {
    $code = 2;
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

echo getApiResult($code, $data, $msg);
?>