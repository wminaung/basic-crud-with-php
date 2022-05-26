<?php
require 'config.php';
session_start();

if (!empty($_POST)) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    if ($email == '' || $pass == '') {
        echo '<script>alert("Fill all input field!!");</script>';
    } else {
        $qry = "SELECT * FROM users where email=:email";
        $statement = $pdo->prepare($qry);
        $statement->execute(array(':email' => $email));
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            echo "user is not valid";
        } else {
            $id = $user['id'];
            // SESSION

            $validPassword = password_verify($pass, $user['password']);

            if ($validPassword) {
                $_SESSION['id'] =  $id;
                header('Location: index.php');
                exit();
            } else {
                echo '<script>alert("Invalid Password!!");</script>';
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
        <!--###########form###########-->
        <form style="color: #6c757d;" action="login.php" method="post">
            <div>
                <h1>Login</h1>
                <hr>
            </div>

            <div class="form-group">
                <label for="">Email address</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary" value="Login" name="submit">
                <a href="register.php">Register</a>
            </div>
        </form>

        <footer>

            <i><b>dummy mail-pass</b></i>
            <br>
            meail: <i>gust@gmail.com</i>
            <br>
            pass : <i>hello</i>
            <br>

        </footer>
    </div>
</body>

</html>