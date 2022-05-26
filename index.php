<?php
require 'config.php';
session_start();

if (empty($_SESSION['id'])) {
    header('Location:login.php');
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
<style>
    body {
        width: 800px;
    }

    table {
        border: 2px solid white;
    }

    .nlholder {
        display: flex;
        justify-content: space-between;
    }

    a {
        margin-bottom: 4px;
    }
</style>

<body>
    <?php

    $state = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
    $state->execute();
    $items = $state->fetchAll();

    ?>
    <div class="container">

        <table class="table table-striped">
            <div>
                <h1>Posts</h1>
                <hr>
                <div class="nlholder">
                    <a class="btn btn-primary" href="add.php">Add Post</a>

                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </div>
            </div>

            <thead>

                <tr>
                    <th scope="col">id</th>
                    <th scope="col">title</th>
                    <th scope="col">description</th>
                    <th scope="col">created_at</th>
                    <th>extra</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $item) {

                ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['title']; ?></td>
                        <td><?php echo $item['description']; ?></td>
                        <td><?php echo $item['created_at']; ?></td>
                        <td>
                            <a class="badge badge-pill badge-info" href="edit.php?id=<?php echo $item['id']; ?>">Edit</a><br>
                            <a class="badge badge-pill badge-info" href="delete.php?id=<?php echo $item['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>


    </div>
</body>

</html>