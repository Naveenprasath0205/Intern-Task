<?php
require 'vendor/autoload.php';

// Assuming local MongoDB instance
$mongoURI = "mongodb://localhost:27017";
$dbName = "profiles";
$collectionName = "signup";

try {
    // Connect to MongoDB
    $client = new MongoDB\Client($mongoURI);
    $db = $client->$dbName;
    $collection = $db->$collectionName;

    // Start session
    session_start();
    $email = $_SESSION['email'];

    if (!empty($email)) {
        // Find document based on email
        $document = $collection->findOne(["email" => $email]);

        if (!empty($document)) {
            // Output retrieved data
            echo "Age: " . $document['age'] . "<br>";
            echo "Date of Birth: " . $document['dob'] . "<br>";
            echo "Phone: " . $document['contact'] . "<br>";
            $_SESSION['age']= $document['age'];
            $_SESSION['dob']= $document['dob'];
            $_SESSION['ph']= $document['contact'];
        } else {
            echo "No profile found for the email: $email";
        }
    } else {
        echo "Email is missing!";
    }
} catch (MongoDB\Exception\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>