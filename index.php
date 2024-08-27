<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vehicle List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        
        <?php
        include "header.php";
        ?>

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
                                unset ($_SESSION["create"]);
                            ?>
                        </div>
                    <?php
                }
            ?>
            <?php
                if (isset($_SESSION["edit"])) {
                    ?>
                        <div class="alert alert-success">
                            <?php
                                echo $_SESSION["edit"];
                                unset ($_SESSION["edit"]);
                            ?>
                        </div>
                    <?php
                }
            ?>
            <?php
                if (isset($_SESSION["delete"])) {
                    ?>
                        <div class="alert alert-success">
                            <?php
                                echo $_SESSION["delete"];
                                unset ($_SESSION["delete"]);
                            ?>
                        </div>
                    <?php
                }
            ?>

            <?php
            require_once "connect.php";

            // Count the total number of vehicles
            $result = $conn->query("SELECT COUNT(*) AS total FROM vehicles");
            $row = $result->fetch_assoc();
            $totalVehicles = $row['total'];
            ?>

            <table class="table">
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
                        <th colspan="8">Total Vehicles: <?php echo $totalVehicles; ?></th>
                    </tr>
                    <tr>
                        <th>No.</th>
                        <th>#ID</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Registration Number</th>
                        <th>Image</th> <!-- New column for image -->
                        <th>
                            <td></td>
                        </th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    include "connect.php";

                    $sql = "SELECT * FROM vehicles";
                    $result = mysqli_query($conn, $sql);

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
                            
                            <td></td>
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