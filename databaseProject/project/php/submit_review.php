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
$movieId = $_POST['movieId'];
$userId = $_POST['userId'];
$userPassword = $_POST['password'];
$reviewText = $_POST['reviewText'];
$rating = $_POST['rating'];

//check if the password is correct
$sql = "SELECT password FROM users WHERE id = '$userId'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if(password_verify($userPassword, $row['password'])){
        //insert review
        $sql = "INSERT INTO user_reviews (user_id, movie_id, review_text, rating) VALUES ('$userId', '$movieId', '$reviewText', '$rating')";

        if($conn->query($sql) === TRUE){
            $last_id = $conn->insert_id;
            echo "Thanks for your review! Your review ID is " . $last_id . ".";
        }
        else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        echo "Incorrect password.";
        echo '<a href="..\html\write_review.html"> Retry </a>';
        exit();

    }
}
else{
    echo "User not found.";
    echo '<a href="..\html\delete_review.html"> Retry </a>';
    exit();
}

$conn->close();

?>

<a href="..\index.html">Back to index</a>
