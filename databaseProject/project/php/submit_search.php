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
$movieTitle = $_POST['movieTitle'];

//sql query
$sql = "SELECT m.movie_id, m.title, m.release_year, m.genre, m.description, m.avg_votes, m.votes, d.first_name AS director_first_name, d.last_name AS director_last_name, GROUP_CONCAT(CONCAT(a.first_name, ' ', a.last_name) SEPARATOR ', ') AS actors
FROM movies m
JOIN directors d ON m.director_id = d.director_id
JOIN movie_cast mc ON m.movie_id = mc.movie_id
JOIN actors a ON mc.actor_id = a.actor_id
WHERE m.title LIKE '%$movieTitle%'
GROUP BY m.movie_id";

$result = $conn->query($sql);

if($result !== FALSE){
    while($row = $result->fetch_assoc()){
        echo "<h2><center>Title: " . $row["title"]. " ||| movie-id: " . $row["movie_id"] . "</center></h2>";
        echo "<p><strong>Release Year:</strong> " . $row["release_year"] ."</p>";
        echo "<p><strong>Genre:</strong> "  . $row["genre"] ."</p>";
        echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";
        echo "<p><strong>Avg Vote:</strong> " .  $row["avg_votes"] . "</p>";
        echo "<p><strong>Vote:</strong> " . $row["votes"] . "</p>";
        echo "<p><strong>Director:</strong> " . $row["director_first_name"] . " " . $row["director_last_name"] . "</p>";
        echo "<p><strong>Actors:</strong> " . $row["actors"] . "</p>";
        echo "<hr>";
    }
}
else{
    echo "fail ".$sql."<br>".$conn->error;
}

?>

<a href="..\index.html">Back to index</a>
