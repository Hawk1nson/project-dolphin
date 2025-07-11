<!-- 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬
-->

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$page_title = 'Project ABCD > Celebrations';

// Database connection info
$host = "localhost";
$user = "root";
$pass = "";
$db = "abcd_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch celebrations data
$sql = "SELECT * FROM celebrations_tbl ORDER BY celebration_date";
$result = $conn->query($sql);
?>

<?php include('header.php'); ?>

<head>
    <link rel="stylesheet" type="text/css" href="css/list_celebrations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

</head>
<br><br>
<div class="container-fluid">
    <h2 id="title">Celebrations</h2><br>

    <div class="row justify-content-center">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                /* pulls image name from DB
                    make sure to have correct directory structure!
                    'celebrations_default.png' is whatever the default image you want to use
                */
                $imagePath = "images/celebrations/" . ($row['image_name'] ?? 'celebrations_default.png'); // in DB, if 'image_name' is NULL, then will use 'celebrations_default.png' as default image
                $title = htmlspecialchars($row['title']);
                $description = htmlspecialchars($row['description']);
                $id = $row['id'];
                echo <<<HTML
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 shadow">
                        <img src="$imagePath" class="card-img-top img-fluid" alt="$title">
                        <div class="card-body">
                            <h5 class="card-title">$title</h5>
                            <p class="card-text">$description</p>
                            <a href="display_celebration.php?id=$id" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                HTML;
            }
        } else {
            echo "<p>No celebrations found.</p>";
        }
        ?>
    </div>
</div>
