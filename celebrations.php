<?php
if(!isset($_SESSION)) {
    session_start();
}

require 'db_configuration.php';
$page_title = 'Project ABCD > Celebrations';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$query = "SELECT * FROM celebrations_tbl";
$GLOBALS['data'] = mysqli_query($db, $query);
?>

<?php include('header.php'); ?>

<head>
    <link rel="stylesheet" type="text/css" href="css/list_dresses.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
</head>

<br><br>
<div class="container-fluid">
    <h2 id="title">Today's Celebrations</h2><br>

    <div id="buttonContainer" style="margin-bottom: 20px;">
        <button><a class="btn btn-sm" href="create_celebration.php">Add a Celebration</a></button>
    </div>

    <div id="customerTableView">
        <table class="display" id="celebrationsTable" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Resource Type</th>
                    <th>Celebration Type</th>
                    <th>Date</th>
                    <th>Tags</th>
                    <th>Image</th>
                    <th>Resource Link</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($GLOBALS['data'])) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['resource_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['celebration_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['celebration_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['tags']); ?></td>
                        <td><img src="images/celebrations/<?php echo htmlspecialchars($row['image_name'] ?: 'celebrations_default.png'); ?>" width="60px"></td>
                        <td>
                            <?php if (!empty($row['resource_url'])): ?>
                                <a href="<?php echo htmlspecialchars($row['resource_url']); ?>" target="_blank">View</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#celebrationsTable').DataTable();
    });
</script>
