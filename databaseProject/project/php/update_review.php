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
$reviewId = $_POST['reviewId'];
$userId = $_POST['userId'];
$userPassword = $_POST['password'];
$newReviewText = $_POST['newReviewText'];
$newRating = $_POST['newRating'];

//check if the password is correct
$sql = "SELECT password FROM users WHERE id = '$userId'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if(password_verify($userPassword, $row['password'])){
        //update review
        $sql = "UPDATE user_reviews SET review_text = '$newReviewText', rating = '$newRating' WHERE review_id = '$reviewId'";

        if($conn->query($sql) === TRUE){
            echo "Review updated successfully.";
        }
        else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        echo "Incorrect password.";
        echo '<a href="..\html\update_review.html"> Retry </a>';
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
