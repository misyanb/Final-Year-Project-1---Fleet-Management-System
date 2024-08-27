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
      <title>Registration Form</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" href="styles.css">
    </head>
    
    <body>

        <div class="container">
          <header class="text-center my-4">
              <h1>Fleet Management System</h1>
              <p class="lead">Sign up to continue</p>
          </header>
          <?php
          
            if (isset($_POST["submit"])) {

              $fullName = $_POST["name"];
              $email = $_POST["email"];
              $userName = $_POST["username"];
              $password = $_POST["password"];
              $passwordRepeat = $_POST["repeat_password"];

              $passwordHash = password_hash($password, PASSWORD_DEFAULT);

              $errors = array(); // Check array if empty

              if (empty($fullName) || empty($email)  || empty($userName) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
              }
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
              }
              if (strlen($password) < 2) {
                array_push($errors, "Password must be at least 2 characters long");
              }
              if ($password !== $passwordRepeat) {
                array_push($errors, "Password does not match");
              }

              require_once "connect.php";
              $sql = "SELECT * FROM members WHERE email = '$email'";
              $result = mysqli_query($conn, $sql);
              $rowCount = mysqli_num_rows($result);
              if($rowCount > 0) {
                array_push($errors, "Email already exists!");
              }

              if (count($errors) > 0) {
                foreach ($errors as $error) {
                  echo "<div class='alert alert-danger'>$error</div>";
                }
              } else {
                // Insert data into db
                $sql = "INSERT INTO members (name, email, username, password) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                  mysqli_stmt_bind_param($stmt, "ssss", $fullName, $email, $userName, $passwordHash);
                  mysqli_stmt_execute($stmt);
                  echo "<div class='alert alert-success'>You are registered successfully</div>";
                  // Redirect to index.php
                  header("Location: login.php");
                  exit(); // Ensure no further code is executed
                } else {
                  die("Something went wrong");
                }
              }
            }
          ?>

          <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-warning mx-2" name="submit" value="Register">
                <a href="welcome.php" class="btn btn-primary mx-2">Back</a>
            </div>
          </form>
        </div>

        <?php
            include "foot.php";
            ?>
        
    </body>
</html>
