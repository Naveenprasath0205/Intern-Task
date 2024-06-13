<?php

require "predis/autoload.php";
$redis = new Predis\Client();

if($redis)
{
    //echo "connection successful";
}
else{
    echo "Not connected";
}
$set = $redis->hmget('data','email','login','name','age','dob','ph');
echo json_encode($set);

?> 