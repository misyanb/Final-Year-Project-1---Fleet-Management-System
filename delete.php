<?php
if (isset($_GET["vehicle_id"])) {
    $id = $_GET["vehicle_id"];

    include "connect.php";

    $sql = "DELETE FROM vehicles WHERE vehicle_id = $id";

    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["create"] = "Vehicle Deleted Successfully";
        header("Location: index.php");
        exit(); // Ensure no further code is executed
    } else {
        die("Something went wrong");
    }
}
?>
