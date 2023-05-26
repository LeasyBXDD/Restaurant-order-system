<?php
header('Content-Type: application/json');

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'admin' && $password === '123456') {
    echo json_encode(array('success' => true));
} else {
  echo json_encode(array('success' => false));
}
?>