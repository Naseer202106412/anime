<?php
include 'dbinfo.php';

$animes_query = "SELECT * FROM animes";
$animes_result = mysqli_query($con, $animes_query);

$background_image_url = "image1.jpg"; 

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>animes</title>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background-image: url('image1.jpg'); 
        background-size: cover;
        background-position: center;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
    }
    h1 {
        text-align: center;
    }
    .anime {
        display: flex;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .anime img {
        width: 150px;
        height: auto;
        border-radius: 5px;
        margin-right: 20px;
    }
    .anime-content {
        flex: 1;
    }
    .anime-title {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }
    .anime-superpower {
        font-size: 16px;
        color: #666;
    }
    .add-form {
        margin-top: 20px;
    }
    .add-form h3 {
        text-align: center;
    }
    .add-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .add-form input[type="text"],
    .add-form textarea {
        width: calc(100% - 18px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .add-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #400b0d;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .add-form input[type="submit"]:hover {
        background-color: #400b0d;
    }
</style>
</head>
<body>

<div class="container">
    <h1>animes Details</h1>

    <?php
    if ($animes_result->num_rows > 0) {
        while($row = $animes_result->fetch_assoc()) {
            echo "<div class='anime'>";
            echo "<img src='" . $row["image_url"] . "' alt='anime Image'>";
            echo "<div class='anime-content'>";
            echo "<div class='anime-title'>" . $row["title"] . "</div>";
            echo "<div class='anime-superpower'>" . substr($row["content"], 0, 100) . "...</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No animes found</p>";
    }
    ?>

    <div class="add-form">
        <h2>which anime do you want to add?</h2>
        <form method="post" action="add-anime.php">
            <label for="anime_title">anime Name</label><br>
            <input type="text" id="anime_title" name="anime_title" required><br>
            <label for="anime_content">Details</label><br>
            <textarea id="anime_content" name="anime_content" required></textarea><br>
            <label for="anime_image_url">Image URL:</label><br>
            <input type="text" id="anime_image_url" name="anime_image_url"><br><br> 
            <input type="submit" name="add_anime" value="Add your anime">
        </form>
    </div>
</div>
</body>
</html>
