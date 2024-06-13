<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['name'])) {
    $name = $_POST['name'];
    echo "name: " . $name . "\n";
  }
  if(isset($_POST['email'])) {
    $email = $_POST['email'];
    echo "email: " . $email . "\n";
  }
  if(isset($_POST['pass'])) {
    $pass = $_POST['pass'];
    echo "pass: " . $pass;
  }

  $servername = "localhost";
  $username = "abi";
  $password = "abi";
  $dbname = "userdetails";
  $dname = "signupdetails";
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if(mysqli_connect_error()){
      die("Connection error:" . mysqli_connect_error());
  }
  
  echo "Connection successful.";
  $sql = "INSERT INTO $dname (`name`, `email`, `pass`) VALUES (?, ?, ?)";
  
  $stmt = mysqli_stmt_init($conn);
  
  if( ! mysqli_stmt_prepare($stmt, $sql)){
      die(mysqli_error($conn));
  }
  
  mysqli_stmt_bind_param($stmt, "sss",  $name, $email, $pass);
  mysqli_stmt_execute($stmt);
  echo "Record Saved";
  //----mongo
  require 'vendor/autoload.php';
$mongoURI = "mongodb://localhost:27017"; // Assuming local MongoDB instance
$dbName = "profiles";
$collectionName = "signup";

try {
    // Connect to MongoDB
    $client = new MongoDB\Client($mongoURI);
    $db = $client->$dbName;
    $collection = $db->$collectionName;

    // Create data to insert
    $data = [
      "email" => $email,
        "age" => "",
        "dob" => "",
        "contact" => ""
    ];

    // Insert data into MongoDB collection
    $insertResult = $collection->insertOne($data);

    if ($insertResult->getInsertedId() !== null) {
        echo "Profile Data Updated!";

    } else {
        echo "Error storing Profile data. Please try again.";
    }

} catch (MongoDB\Exception\Exception $e) {
    echo "Error: " . $e->getMessage();
}
}

?>