<?php
/* 
    ICS 325 (summer 2025)
    Final Project
    Team DOLPHIN  🐬

        FP2
    celebrations.php created
    STRETCH GOAL:
    Admin --> celebrations page will bring the data from "celebrations_tbl" as JQuery data table
*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("header.php");

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "abcd_db"; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get celebrations data
$result = $conn->query("SELECT * FROM celebrations_tbl");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Celebrations (Admin)</title>
    <!-- DataTables CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>
    <h2 style="text-align:center;">🎉 Celebration Resources</h2>
    <div style="width:95%; margin:auto;">
    <table id="celebrationsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Resource Type</th>
                <th>Celebration Type</th>
                <th>Date</th>
                <th>Tags</th>
                <th>Resource Link</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= htmlspecialchars($row["title"]) ?></td>
                <td><?= htmlspecialchars($row["description"]) ?></td>
                <td><?= $row["resource_type"] ?></td>
                <td><?= $row["celebration_type"] ?></td>
                <td><?= $row["celebration_date"] ?></td>
                <td><?= htmlspecialchars($row["tags"]) ?></td>
                <td><a href="<?= $row["resource_url"] ?>" target="_blank">View Resource</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#celebrationsTable').DataTable();
        });
    </script>
</body>
</html>

<?php include("footer.php"); ?>
