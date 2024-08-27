<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <?php
        include "header.php";
    ?>

</head>
<body>
    <div class="container">

        <header class="d-flex justify-content-between my-4 custom-header">
            <h2>Vehicle Details</h2>
            <div>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </header>

        <div class="vehicle-details my-4">


            <?php
                if (isset($_GET["vehicle_id"])) {
                    $id = $_GET["vehicle_id"];

                    include "connect.php";

                    $sql = "SELECT * FROM vehicles WHERE vehicle_id=$id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    ?>

                    <p></p>
                    <h3>Image</h3>
                    <p>
                    <?php if ($row['image']) { ?>
                                    <div class="text-center">
                                        <img src="<?php echo $row['image']; ?>" class="rounded" alt="Vehicle Image" style="width: 300px; height: auto;">
                                    </div>
                                    
                                <?php } else { ?>
                                    No Image
                                <?php } ?>
                    </p>
                    <h3>Registration Number</h3>
                    <p><?php echo $row["reg_number"]; ?></p>
                    <h3>Make</h3>
                    <p><?php echo $row["make"]; ?></p>
                    <h3>Model</h3>
                    <p><?php echo $row["model"]; ?></p>
                    <h3>Year Manufactured</h3>
                    <p><?php echo $row["year_manufactured"]; ?></p>
                    <h3>Year Registered</h3>
                    <p><?php echo $row["year_registered"]; ?></p>
                    
                    <?php
                }
            ?>

        </div>

        <div class="d-flex justify-content-center">
            <a href="regulatoryrecord.php?vehicle_id=<?php echo $row["vehicle_id"] ?>" class="btn btn-warning mb-2 mx-2">Regulatory Record</a>
            <a href="maintenancerecord.php?vehicle_id=<?php echo $row["vehicle_id"] ?>" class="btn btn-warning mb-2 mx-2">Maintenance Record</a>
        </div>
        <div class="d-flex justify-content-center">
        
        </div>
        <div class="d-flex justify-content-center">
            <a href="edit.php?vehicle_id=<?php echo $row["vehicle_id"] ?>" class="btn btn-outline-success mb-2 mx-2" target="_blank">Edit</a>
            <a href="delete.php?vehicle_id=<?php echo $row["vehicle_id"] ?>" onclick="return confirm('Are you sure you want to delete this entry?');" class="btn btn-danger mb-2 mx-2">Delete</a>
        </div>

    </div>

    <?php
        include "foot.php";
    ?>

    
</body>
</html>