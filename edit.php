<?php 
    require_once("server.php");
    if(isset($_POST["sub"] )) {
        $id = $_GET["userid"];
        $name = $_POST["name"];
        $email = $_POST["Email"];
        $roomNo = $_POST["Room_no"];
        $ext = $_POST["ext"];
        $update_sql = "update users set name = '$name', email = '$email', room_no = '$roomNo', ext = '$ext' where id = $id";
        mysqli_query($connection, $update_sql);
        header("location: profile_dashboard.php");
    }

    
    $username = $_GET["username"];
    $id = $_GET["userid"];
    $select_sql = "select * from users where id = $id";
    $edit = mysqli_query($connection, $select_sql);
    $info = mysqli_fetch_array($edit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit User</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $info['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="text" class="form-control" id="Email" name="Email" value="<?php echo $info['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="Room_no" class="form-label">Room No</label>
                <input type="text" class="form-control" id="Room_no" name="Room_no" value="<?php echo $info['room_no']; ?>">
            </div>
            <div class="mb-3">
                <label for="ext" class="form-label">Ext</label>
                <input type="text" class="form-control" id="ext" name="ext" value="<?php echo $info['ext']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="sub">Submit</button>
        </form>
    </div>

</body>
</html>
