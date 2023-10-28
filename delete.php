<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <style>
        .custom-alert {
            border: 2px solid red;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<?php
require_once("server.php");
$username = $_GET["username"];
$id = $_GET["userid"];
echo 
"<h1 class='alert alert-success' style='border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);' >$username has been deleted successfully</h1>"; 
$sql = "delete from users where id = $id";
$delete_1 = mysqli_query($connection, $sql);
header("refresh:2;url=http://localhost/labs/profile_dashboard.php");
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
