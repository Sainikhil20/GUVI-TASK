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
$username = $_POST['username'];
$password = $_POST['password'];

// Check if any field is empty and send a message in JSON to AJAX
if (empty($username) || empty($password)) {
    echo json_encode(array('message' => 'Fill all the fields'));
    exit();
}

// Store the username and password data in MySQL
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) !== true) {
    echo json_encode(array('message' => 'Error: ' . $sql . '<br>' . $conn->error));
    exit();
}

// Check if the username and password match in the database
$select = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");

if (mysqli_num_rows($select)) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('message' => 'Invalid username or password'));
    exit();
}



$conn->close();
exit();
?>
