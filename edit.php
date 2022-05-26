<?php
require "config.php";

$idToEdit =  $_GET['id'];



if (!empty($_POST)) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $created_at = $_POST['created_at'];


    if (empty($_FILES['image']['name'])) {
        $stmt = $pdo->prepare(
            "UPDATE posts SET title='$title', description='$desc', created_at='$created_at' WHERE id=$idToEdit"
        );
        $isUpdated = $stmt->execute();
        if ($isUpdated) {
            header('Location: index.php');
        } else {
            echo '<script>alert("Data is Not Updated!");</script>';
        }
    } else {
        // if image update 

        // check img extension
        $imgType = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if ($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg') {
            echo '<script>alert("File extension is not invalid, Please choose the right file extension <png,jpg,jpeg>");</script>';
        } {
            $fileName = $_FILES['image']['name'];
            $from = $_FILES['image']["tmp_name"];
            $to = "images/" . $fileName;
            $isMove = move_uploaded_file($from, $to);
            if (!$isMove) {
                echo '<script>alert("File Upload Fail!");</script>';
            } else {
                //if file were move, update database image-column 
                $stmt = $pdo->prepare(
                    "UPDATE posts SET title='$title', description='$desc',
                    image='$fileName',
                     created_at='$created_at' WHERE id=$idToEdit"
                );
                $isUpdated = $stmt->execute();
                if ($isUpdated) {
                    echo '<script>alert("You are now Updated post!!");</script>';
                    header('Location: index.php');
                } else {
                    echo '<script>alert("Data is Not Updated!");</script>';
                }
            }
        }
    }
}



$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=$idToEdit");
$stmt->execute();

$items = $stmt->fetch(PDO::FETCH_ASSOC);

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


        <form style="color: #6c757d;" action="edit.php?id=<?php echo $items['id'] ?>" method="post" enctype="multipart/form-data">
            <div>
                <h1>Update Post</h1>
                <hr>
            </div>
            <div class="form-group">
                <label for="">Update Post Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $items['title'] ?>">
            </div>
            <div class="form-group">
                <label for="">Update Post Description</label>
                <textarea class="form-control" name="description" rows="4"><?php echo $items['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Update Created Date</label>
                <input type="date" class="form-control" name="created_at" value="<?php echo $items['created_at'] ?>" required>
            </div>

            <div class="form-group">
                <label for="">Update Photo</label>
                <input type="file" name="image">
                <img src="images/<?php echo $items['image']  ?>" width="100" alt="somePhoto">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary" value="Update" name="submit">
                <a class="btn btn-info float-right" href="index.php">back</a>
            </div>
        </form>


    </div>
</body>

</html>