<?php
session_start();
echo json_encode($_SESSION);
$_SESSION['login']=0;
?>