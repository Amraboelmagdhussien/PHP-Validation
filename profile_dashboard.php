<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .carousel img {
            max-width: 100%;
            height: auto;
            margin: 0 auto; /* Center the images horizontally */
        }

        #imageCarousel {
            max-width: 800px; /* Adjust the maximum width as needed */
            margin: 0 auto; /* Center the carousel container horizontally */
        }
    </style>
</head>
<body>

    <div class="container">
        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://www.collidu.com/media/catalog/product/img/5/2/52aa8b1c2716376a787cf233baf04ef009dc09a941eecfd415bec6ecafd3c42d/database-archiving-slide3.png" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="https://www.slideegg.com/image/catalog/44145-database%20powerpoint%20template.png" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="https://www.collidu.com/media/catalog/product/img/8/3/83ad9d80e654e3b8efcdda4210c34aa98327ae51fd0aa47da8162a5261e2bcbf/relational-database-management-system-slide1.png" alt="Image 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Room No</th>
                            <th>Ext</th>
                            <th>Remove User</th>
                            <th>Modify</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once('server.php');
                        $sql = "select * from users";
                        $result = mysqli_query($connection, $sql);
                        while ($data_1 = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $data_1["id"] . "</td>";
                            echo "<td>" . $data_1["name"] . "</td>";
                            echo "<td>" . $data_1["email"] . "</td>";
                            echo "<td>" . $data_1["room_no"] . "</td>";
                            echo "<td>" . $data_1["ext"] . "</td>";
                            echo "<td><a href='delete.php?userid=$data_1[id]&username=$data_1[name]'>Remove</a></td>";
                            echo "<td><a href='edit.php?userid=$data_1[id]&username=$data_1[name]'>Edit</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="register.php" class="btn btn-primary">Create User</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>