<?php
function getApiResult($code,$data,$msg){
    header("content-type:application/json");
    //拼装成数组
    $output[0]["code"]=$code;
    $output[0]["data"]=$data;
    $output[0]["msg"]=$msg[$code];
    return json_encode($output,JSON_UNESCAPED_UNICODE);

}

?>