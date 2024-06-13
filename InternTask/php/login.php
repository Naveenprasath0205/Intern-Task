<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if(isset($_POST['email'])) {
    $email = $_POST['email'];
    echo "email: " . $email . "\n";
  }
  if(isset($_POST['pass'])) {
    $pass = $_POST['pass'];
    echo "pass: " . $pass ."\n";
  }

  $conn = mysqli_connect("localhost", "abi", "abi", "userdetails");
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  // Fetch data from MySQL
  $sql = "SELECT `email`, `pass`,`name` FROM `signupdetails` WHERE `email` = '$email'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
      die("Error in SQL query: " . mysqli_error($conn));
  }
  // Fetching data from the result
  $row = mysqli_fetch_assoc($result);
  $getemail = $row['email'];
  $getpass = $row['pass'];
  $getname = $row['name'];
  echo "getname ". $getemail ."\n";
  echo "getpass ".$getpass ."\n";
  echo "getname ".$getname ."\n";
  // Close the connection
  mysqli_close($conn);
  
//-----redis------//
require "predis/autoload.php";
    $redis = new Predis\Client();
    if ($email=="" && $pass=="")
{}
else {
  if($email==$getemail && $pass==$getpass)
  {
    $redis->hmset('data','email',"$getemail",'login',"1",'name',"$getname");
    $print = $redis->hmget('data','email','login','name');
    echo $print[2];
  }
  else
  {
    $redis->hmset('data','login',"0");
  }
}
//-----------------//
  }
?>