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

    require "predis/autoload.php";
    $redis = new Predis\Client();
    $redisemail = $redis->hmget('data','email');
    $email = $redisemail[0];


    if (!empty($email)) {
        // Find document based on email
        $document = $collection->findOne(["email" => $email]);

        if (!empty($document)) {
            // Output retrieved data
            echo "Age: " . $document['age'] . "<br>";
            echo "Date of Birth: " . $document['dob'] . "<br>";
            echo "Phone: " . $document['contact'] . "<br>";
            $redis->hmset('data','age', $document['age']);
            $redis->hmset('data','dob',$document['dob']);
            $redis->hmset('data','ph',$document['contact']);
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