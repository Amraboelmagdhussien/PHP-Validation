<?php

require_once("server.php");
$sql = "select * from users";
$res =  mysqli_query($connection, $sql);


// while ($data_1 = mysqli_fetch_array($res)) {
//     print_r($data_1);
// }

?>


<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
</head>
<body>
    <h1>Lab 04</h1>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Room No</th>
            <th>Ext</th>
            <td>Remove User</td>
            <td>Modify</td>
        </tr>
        <?php
        // show data in table
        while ($data_1 = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>".  $data_1["id"]   . "</td>";
            echo "<td>".  $data_1["name"]   . "</td>";
            echo "<td>".  $data_1["email"]   . "</td>";
            echo "<td>".  $data_1["room_no"]   . "</td>";
            echo "<td>".  $data_1["ext"]   . "</td>";
            echo "<td><a href='delete.php?userid=$data_1[id]&&username=$data_1[name]'>Remove</a></td>";
            echo "<td><a href='edit.php?userid=$data_1[id]&&username=$data_1[name]'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>


