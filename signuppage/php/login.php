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
  //--start session--//
  session_start();
if ($email=="" && $pass=="")
{}
else {
  if($email==$getemail && $pass==$getpass)
  {
    $_SESSION['email']= $getemail;
    $_SESSION['login']= 1;
    $_SESSION['name']= $getname;
    $_SESSION['age']= "";
    $_SESSION['dob']="";
    $_SESSION['ph']="";
  }
  else
  {
    $_SESSION['login']= 0;
  }
}

}
else {
  session_destroy();
}
?>