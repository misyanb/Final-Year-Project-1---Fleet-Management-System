<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulatory Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <?php
        include "header.php";
    ?>

</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Regulatory Record</h1>
            <div>
                <a href="view.php?vehicle_id=<?php echo $_GET['vehicle_id']; ?>" class="btn btn-primary">Back</a>
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
                    <h2>Vehicle's Registration Number</h2>
                    <p><?php echo $row["reg_number"]; ?></p>
                    <h2>Roadtax Expiry Date</h2>
                    <p><?php echo $row["roadtax_exp_date"]; ?></p>
                    <h2>Insurance Expiry Date</h2>
                    <p><?php echo $row["insurance_exp_date"]; ?></p>
                    <h2>Puspakom</h2>
                    <p><?php echo $row["puspakom"]; ?></p>

                    <?php
                }
            ?>

        </div>
    </div>

    <?php
            include "foot.php";
            ?>
</body>
</html>
