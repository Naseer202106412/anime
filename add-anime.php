<?php
include 'dbinfo.php';


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_anime'])) {

    $title = sanitize_input($_POST['anime_title']);
    $content = sanitize_input($_POST['anime_content']);
    $image_url = isset($_POST['anime_image_url']) ? sanitize_input($_POST['anime_image_url']) : ''; // Image URL is optional


    $sql = "INSERT INTO animes (title, content, image_url) VALUES ('$title', '$content', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo "anime added successfully";
    
        header("Location: anime-index.php");
        exit();
    } else {
        echo "Error adding anime: " . $conn->error;
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$conn->close();
?>