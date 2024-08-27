<!-- maintenancerecord.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vehicle Maintenance Records</title>
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

            // Get the vehicle_id from the URL
            $vehicle_id = $_GET['vehicle_id'];

            // Fetch the registration number for the specific vehicle
            $sql_vehicle = "SELECT reg_number FROM vehicles WHERE vehicle_id = ?";
            $stmt_vehicle = $conn->prepare($sql_vehicle);
            $stmt_vehicle->bind_param("i", $vehicle_id);
            $stmt_vehicle->execute();
            $result_vehicle = $stmt_vehicle->get_result();
            $vehicle = $result_vehicle->fetch_assoc();
            $regnum = $vehicle['reg_number'];

            // Fetch maintenance records for the specific vehicle
            $sql = "SELECT m.maintenance_id, m.vehicle_id, v.reg_number, v.image, m.service_date, m.service_type, m.service_provider, m.cost, m.parts_used, m.mileage, m.service_notes, m.next_service_due 
                    FROM maintenance_history m 
                    JOIN vehicles v ON m.vehicle_id = v.vehicle_id
                    WHERE m.vehicle_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $vehicle_id);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <header class="d-flex justify-content-between my-4">
                            <div>
                                <h3></h3>
                                <a href="view.php?vehicle_id=<?php echo $_GET["vehicle_id"] ?>" class="btn btn-primary">Back to Vehicle Records</a>
                            </div>
                        </header>
                    </tr>
                    <tr><th colspan="11"><h3>Maintenance Record</h3></th></tr>
                    <tr><th colspan="11"></th></tr>
                    <tr>
                        <th colspan="11">Registration Number: <?php echo $regnum; ?></th>
                    </tr>
                    <tr><th colspan="11"></th></tr>
                    <tr>
                        <th>No.</th>

                        <th>Service Date</th>
                        <th>Service Type</th>
                        <th>Service Provider</th>
                        <th>Cost</th>
                        <th>Parts Used</th>
                        <th>Mileage</th>
                        <th>Service Notes</th>
                        <th>Next Service Due</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $counter = 1; // Initialize the counter
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $counter; ?></td> <!-- Display the counter value -->

                            <td><?php echo $row["service_date"]; ?></td>
                            <td><?php echo $row["service_type"]; ?></td>
                            <td><?php echo $row["service_provider"]; ?></td>
                            <td><?php echo $row["cost"]; ?></td>
                            <td><?php echo $row["parts_used"]; ?></td>
                            <td><?php echo $row["mileage"]; ?></td>
                            <td><?php echo $row["service_notes"]; ?></td>
                            <td><?php echo $row["next_service_due"]; ?></td>
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
