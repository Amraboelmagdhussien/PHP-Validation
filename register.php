<?php
// require_once("server.php");
// $sql = "select * from users";
// $cre = mysqli_query($connection, $sql);
    
// while ($data_1 = mysqli_fetch_array($cre)) {
//     print_r($data_1);
// }
$nameError = $emailError = $passwordError = $confPasswordError = $fieldError = '';

if(isset($_POST["sub"])) {
    require_once("server.php");
    $name = $_POST["name"];
    $email = $_POST["Email"];
    $password = $_POST["password"];
    $conPassword = $_POST["conf-password"];
    $roomNo = $_POST["Room_no"];
    $ext = $_POST["ext"];
    $profilepic = $_FILES["profilepic"];
    $encryption = md5($password);



    $data = "Name: $name\n";
    $data .= "Email: $email\n";
    $data .= "Password: $encryption\n";
    $data .= "Room No: $roomNo\n";
    $data .= "Extension: $ext\n";


$file_name = $profilepic["name"];
$tmppath = $profilepic["tmp_name"];
$file_size = $profilepic["size"];
$fileName = explode(".", $file_name);  // awl myshof dot y2t3 klma mn b3d no2ta
$extn = end($fileName); // bmsk a5r element fe array
$extn = strtolower($extn);  // ashan aavoid ay haga upper case tbwz l extension
$extAllow = ["jpg", "png", "gif", "jpeg","pdf","txt"]; // l extension l matloba


in_array($extn, $extAllow); // l extension l ana mskto bdwr fe extension el allow

    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $password_pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/"; 

    // if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     true
    // } else {
    //     echo "Invalid email address<br>";
    // }

    
    if ($name && $email && $password && $conPassword && $roomNo && $ext) {
        $checkNameQuery = "SELECT * FROM users WHERE name = '$name'";
        $nameResult = mysqli_query($connection, $checkNameQuery);


        if (preg_match($password_pattern, $password)) { 
            if(preg_match($pattern, $email)) {

                if ($password !== $conPassword) {
                    $confPasswordError = "Your passwords must match.";
                } else {
                    if (mysqli_num_rows($nameResult) > 0) {
                        $nameError = "A user with this name already exists. Please choose a different name.";
                    } else {
                        if (in_array($extn, $extAllow)) {
                            if ($file_size > 40000) {
                                echo "file Name is Too big";
                            } else {
                                // $save_img = fopen("userinfo.txt","a");
                                // fwrite($save_img,"\n" .$file_name. ""); 
                                $sql = "insert into users (name, Email, password, room_no, ext, profile_picture) values ('$name','$email', '$encryption', $roomNo, $ext, '$profilepic')";
                                $cre = mysqli_query($connection, $sql);
                                move_uploaded_file($tmppath, "images/".$file_name);// bn2l mn tmp path sora l folder images l e7na 3mleno
                                $file = fopen("usersInfo.txt", "a");
                                fwrite($file, $data);
                                fclose($file);
                                header("Location: profile_dashboard.php");
                                
                                exit();
                                
                            }
                        }
                    }
                } 
                    
            } else {
                $emailError = "Please enter a valid email.";
            }
        } else {
            $passwordError = "Password does not meet the requirements.";
        }
    } else {
        $fieldError = "All fields are required.";
    }
}

$nameValue = isset($_POST["name"]) ? $_POST["name"] : "";
$emailValue = isset($_POST["Email"]) ? $_POST["Email"] : "";
$roomNoValue = isset($_POST["Room_no"]) ? $_POST["Room_no"] : "";
$extValue = isset($_POST["ext"]) ? $_POST["ext"] : "";
$profilepicValue = isset($_POST["profilepic"]) ? $_POST["profilepic"] : "";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile_dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1>Register</h1>
    <form method="post" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
            <span class="text-danger"><?php echo $nameError; ?></span>
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="text" class="form-control" id="Email" name="Email">
            <span class="text-danger"><?php echo $emailError; ?></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <span class="text-danger"><?php echo $passwordError; ?></span>
        </div>
        <div class="mb-3">
            <label for="conf-password" class="form-label">Repeat Password</label>
            <input type="password" class="form-control" id="conf-password" name="conf-password">
            <span class="text-danger"><?php echo $confPasswordError; ?></span>
        </div>
        <div class="mb-3">
            <label for="Room_no" class="form-label">Room No</label>
            <input type="text" class="form-control" id="Room_no" name="Room_no">
        </div>
        <div class="mb-3">
            <label for="ext" class="form-label">Ext</label>
            <input type="text" class="form-control" id="ext" name="ext">
        </div>
        <div class="mb-3">
            <label for="profilepic" class="form-label">Upload Profile Picture</label>
            <input type="file" class="form-control" id="profilepic" name="profilepic" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary" name="sub">Submit</button>
        <span class="text-danger"><?php echo $fieldError; ?></span>
    </form>
</div>
    <link rel="stylesheet" href="./bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.3.2-dist/js/bootstrap.min.js"> </script>
</body>
</html>