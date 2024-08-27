<?php
    session_start();
    if (isset($_SESSION["name"])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login Form</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" href="styles.css">

 

    </head>

    <body>


        <div class="container">
        <header class="text-center my-4">
            <h1>Fleet Management System</h1>
            <p class="lead">Log in to existing account to continue</p>
        </header>

            <?php

                if(isset($_POST["login"])) {
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    require_once "connect.php";
                    $sql = "SELECT * FROM members WHERE email= '$email'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    if ($user) {
                        if (password_verify($password, $user["password"])) {
                            session_start();
                            $_SESSION["name"] = "yes"; // Store user ID in session
                            header("Location: index.php");
                            exit(); // Ensure no further code is executed
                        } else {
                            echo "<div class='alert alert-danger'>Password does not match</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Email does not match</div>";
                    }
                }
            ?>
            
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="submit" name="login" class="btn btn-warning mx-2" value="Login">
                    <a href="welcome.php" class="btn btn-primary mx-2">Back</a>
                </div>
            </form>
        </div>

        <?php
            include "foot.php";
        ?>
    </body>
</html>
