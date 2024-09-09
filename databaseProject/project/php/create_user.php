<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "test";

//connect
$conn = new mysqli($host, $username, $password, $database);

//
if($conn -> connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//get user input
$newUsername = $_POST['username'];
$newPassword = $_POST['password'];

//hash the password
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

//check if username already exists
$sql = "SELECT id FROM users WHERE username = '$newUsername'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "Username already exists.";
}
else{
    //create new user
    $role = "user";
    $sql = "INSERT INTO users (username, password, role) VALUES ('$newUsername', '$hashedPassword', '$role')";

    if($conn->query($sql) === TRUE){
        echo "New user created successfully. User ID is: " . $conn->insert_id;
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>

<a href="..\index.html">Back to index</a>
