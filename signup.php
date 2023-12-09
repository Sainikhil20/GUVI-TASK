<?php
// Connect to MySQL database
$servername = "localhost";
$username = "KRCT";
$password = "0088";
$dbname = "login";
$conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Extract the data sent by the AJAX request
   
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    //fill all the fields
    if(empty($_POST['username']) || empty($_POST['password'])){
        echo json_encode( array('message' => 'fill all the fields') );

      exit();
    }
    //if email already exists
    $select = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$_POST['username']."'");
    if(mysqli_num_rows($select)) {
        echo json_encode( array('message' => 'email already exists') );
        exit();
    }
    // Insert the data into MySQL
    $sql = "INSERT INTO users ( username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
       //send data.success is true in json to ajax
        echo json_encode( array('success' => true) );
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
