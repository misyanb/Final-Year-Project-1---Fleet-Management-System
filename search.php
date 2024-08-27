<?php
include "connect.php";

$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM vehicles WHERE reg_number LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM vehicles";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <nav class="navbar navbar-light bg-light justify-content-between my-4 ps-3">
        <a class="navbar-brand" href="index.php">
            <h1>Fleet Management System</h1>
        </a>
        <form class="form-inline d-flex ps-3" method="GET" action="search.php">
            <input class="form-control me-2 flex-grow-1" type="search" name="search" placeholder="Search by Reg. Number" aria-label="Search">
            <button class="btn btn-outline-success me-3" type="submit">Search</button>
        </form>
    </nav>
</head>
<body>
    <div>


        

        <?php
        session_start();
        if (!isset($_SESSION["name"])) {
            header("Location: login.php");
        }

        if (isset($_SESSION["create"])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["create"];
                unset($_SESSION["create"]);
                ?>
            </div>
            <?php
        }

        if (isset($_SESSION["edit"])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["edit"];
                unset($_SESSION["edit"]);
                ?>
            </div>
            <?php
        }

        if (isset($_SESSION["delete"])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
                ?>
            </div>
            <?php
        }
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <header class="d-flex justify-content-between my-4 custom-header">
                        
                        <div>
                            <h3></h3>
                            <a href="create.php" class="btn btn-primary">Add New Vehicle</a>
                        </div>
                    </header>
                    </tr>
                    <tr>
                        <th colspan="8"><h3>Vehicle List</h3></th>
                    </tr>
                <tr>
                    <th>No.</th>
                    <th>#ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Registration Number</th>
                    <th>Image</th>
                    <th>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php

                $counter = 1; // Initialize the counter

                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td> <!-- Display the counter value -->
                        <td><?php echo $row["vehicle_id"] ?></td>
                        <td><?php echo $row["make"] ?></td>
                        <td><?php echo $row["model"] ?></td>
                        <td><?php echo $row["reg_number"] ?></td>
                        <td>
                                <?php if ($row['image']) { ?>
                                    <div class="text-center">
                                        <img src="<?php echo $row['image']; ?>" class="rounded" alt="Vehicle Image" style="width: 300px; height: auto;">
                                    </div>
                                    
                                <?php } else { ?>
                                    No Image
                                <?php } ?>
                            </td>
                        <td><a href="view.php?vehicle_id=<?php echo $row["vehicle_id"] ?>" class="btn btn-info" target="_blank">Read More</a></td>                        
                    </tr>
                    <?php
                    $counter++; // Increment the counter
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    include "foot.php";
    ?>
</body>
</html>
