<?php
require 'config.php';

if (!empty($_POST)) {


    // image add
    $targetFile = "images/" . $_FILES['image']['name'];
    $extenName = pathinfo($targetFile, PATHINFO_EXTENSION);
    if (empty($_FILES['image']['name'])) {
        echo '<script>alert("Photo is necessary");</script>';
    } else {

        if ($extenName != 'jpg' && $extenName != 'png' && $extenName != 'jpeg') {
            echo "<script>alert('Image must be png , jepd or jpg')</script>";
        } else {

            if ($_POST['title'] == '') {
                echo '<script>alert("post at least one title");</script>';
            } else {
                $isMove  =   move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
                // Insert Data if move
                if ($isMove) {
                    $state = $pdo->prepare(
                        "INSERT INTO posts(title,description,created_at,image)
                 VALUES(:title, :description, :created_at, :image)"
                    )->execute(
                        array(
                            ':title' => $_POST['title'], ':description' => $_POST['description'],
                            ':created_at' =>  $_POST['created_at'], ':image' => $_FILES['image']['name']
                        )
                    );

                    if ($state) {
                        echo '<script>alert("You are added new post!");</script>';
                        header("Location:index.php");
                    } else {
                        echo '<script>alert("Post Failed! Try Again");</script>';
                    }
                }
            }
        }
    }
}


?>




<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="container">


        <form style="color: #6c757d;" action="add.php" method="post" enctype="multipart/form-data">
            <div>
                <h1>Add Post</h1>
                <hr>
            </div>
            <div class="form-group">
                <label for="">Add Post Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label for="">Add Post Description</label>
                <textarea class="form-control" name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="">Add Created Date</label>
                <input type="date" class="form-control" name="created_at" value="<?php echo date('Y-m-d') ?>" required>
            </div>
            <div class="form-group">
                <label for="">Add Photo</label>
                <input type="file" name="image">
                <!-- <img src="images/<?php  ?>" width="100" alt="somePhoto"> -->
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary" value="create" name="submit">
                <a class="btn btn-info float-right" href="index.php">back</a>
            </div>
        </form>


    </div>
</body>

</html>