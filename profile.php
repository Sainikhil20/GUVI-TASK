<?php

// MySQL database credentials
$servername = "localhost";
$username = "KRCT";
$password = "0088";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$Username = $_POST['Username'];
$age = $_POST['age'];
$dob = $_POST['dob'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$about = $_POST['about'];

// Check if any field is empty and send a message in JSON to AJAX
if (empty($Username) || empty($age) || empty($dob) || empty($contact) || empty($address) || empty($about)) {
    echo json_encode(array('message' => 'Fill all the fields'));
    exit();
}

// Insert the form data into MySQL
$sql = "INSERT INTO data (Username, age, dob, contact, address, about) 
        VALUES ('$Username', '$age', '$dob', '$contact', '$address', '$about')";

if ($conn->query($sql) === true) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('message' => 'Error: ' . $sql . '<br>' . $conn->error));
}

$conn->close();
exit();
?>
