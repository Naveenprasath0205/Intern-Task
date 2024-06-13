<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['age'])) {
        $age = $_POST['age'];
        echo "age: " . $age . "\n";
    }
    if(isset($_POST['dob'])) {
        $dob = $_POST['dob'];
        echo "dob: " . $dob . "\n";
    }
    if(isset($_POST['ph'])) {
        $ph = $_POST['ph'];
        echo "ph: " . $ph;
    }

    require 'vendor/autoload.php';
    $mongoURI = "mongodb://localhost:27017"; // Assuming local MongoDB instance
    $dbName = "profiles";
    $collectionName = "signup";

    try {
        // Connect to MongoDB
        $client = new MongoDB\Client($mongoURI);
        $db = $client->$dbName;
        $collection = $db->$collectionName;

        session_start();
        $email = $_SESSION['email'];

        // Create data to update
        $updateData = [
            '$set' => [
                "age" => $age,
                "dob" => $dob,
                "contact" => $ph
            ]
        ];

        // Update data in MongoDB collection based on email
        $updateResult = $collection->updateOne(
            ['email' => $email],
            $updateData
        );

        if ($updateResult->getModifiedCount() > 0) {
            echo "Profile Data Updated!";
            $_SESSION['age'] = $age;
            $_SESSION['dob'] = $dob;
            $_SESSION['ph'] = $ph;
        } else {
            echo "No matching profile found for update.";
        }

    } catch (MongoDB\Exception\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
