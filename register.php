<?php
require 'config.php';



if (!empty($_POST)) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {

        $qry = "SELECT * FROM users WHERE email=:email";
        $statement = $pdo->prepare($qry);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (empty($row)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $qry = "INSERT INTO users (name,email,password) 
                    VALUES(:name, :email, :password)";
            $statement = $pdo->prepare($qry);
            $isInsert = $statement->execute(
                array(':name' => $username, ':email' => $email, 'password' => $password)
            );

            if ($isInsert) {
                echo '<script>alert("Registration Success!!");window.location.href="login.php";</script>';
            } else {
                echo "Try insert data again!";
            }
        } else {
            echo "retry other email";
        }
    } else {
        echo "you need to fill all input field";
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


        <form style="color: #6c757d;" action="register.php" method="post">
            <div>
                <h1>Register</h1>
                <hr>
            </div>
            <div class="form-group">
                <label for="">Usernaeme</label>
                <input type="text" class="form-control" name="username">
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
                <input type="submit" class="btn btn-secondary" value="Register" name="submit">
                <a href="login.php">Login</a>
            </div>
        </form>


    </div>
</body>

</html>