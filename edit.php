<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Vehicle</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </header>

        <?php
            if (isset($_GET["vehicle_id"])) {
                $id = $_GET["vehicle_id"];

                include "connect.php";

                $sql = "SELECT * FROM vehicles WHERE vehicle_id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);

                ?>
                <form action="process.php" method="post" enctype="multipart/form-data">
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="regnum" value="<?php echo $row["reg_number"]?>" placeholder="Registration Number">
                    </div>
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="make" value="<?php echo $row["make"]?>" placeholder="Make">
                    </div>
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="model" value="<?php echo $row["model"]?>" placeholder="Model">
                    </div>
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="yearmanufactured" value="<?php echo $row["year_manufactured"]?>" placeholder="Year Manufactured (YYYY)">
                    </div>
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="yearregistered" value="<?php echo $row["year_registered"]?>" placeholder="Year Registered (YYYY)">
                    </div>
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="roadtaxexpdate" value="<?php echo $row["roadtax_exp_date"]?>" placeholder="Roadtax Expiry Date (YYYY-MM-DD)">
                    </div>
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="insuranceexpdate" value="<?php echo $row["insurance_exp_date"]?>" placeholder="Insurance Expiry Date (YYYY-MM-DD)">
                    </div>
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="puspakom" value="<?php echo $row["puspakom"]?>" placeholder="Puspakom">
                    </div>
                    <div class="form-element my-4">
                        <label for="image">Current Image:</label><br>
                        <img src="<?php echo $row['image']; ?>" alt="Vehicle Image" style="max-width: 200px;"><br><br>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <input type="hidden" name="vehicle_id" value='<?php echo $row['vehicle_id']; ?>'>
                    <div class="form-element">
                        <input type="submit" class="btn btn-success" name="edit" value="Edit Vehicle">
                    </div>
                </form>
                <?php 
            }
        ?>
    </div>

    <?php
        include "foot.php";
    ?>
</body>
</html>
