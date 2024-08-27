<?php

include "connect.php";

if (isset($_POST["create"])) {
    $regnum = mysqli_real_escape_string($conn, $_POST["regnum"]);
    $make = mysqli_real_escape_string($conn, $_POST["make"]);
    $model = mysqli_real_escape_string($conn, $_POST["model"]);
    $yearmanufactured = mysqli_real_escape_string($conn, $_POST["yearmanufactured"]);
    $yearregistered = mysqli_real_escape_string($conn, $_POST["yearregistered"]);
    $roadtaxexpdate = mysqli_real_escape_string($conn, $_POST["roadtaxexpdate"]);
    $insuranceexpdate = mysqli_real_escape_string($conn, $_POST["insuranceexpdate"]);
    $puspakom = mysqli_real_escape_string($conn, $_POST["puspakom"]);
    $image = "";

    // Ensure the uploads directory exists
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Handle file upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        } else {
            die("Error uploading file.");
        }
    }

    $sql = "INSERT INTO vehicles (reg_number, make, model, year_manufactured, year_registered, roadtax_exp_date, insurance_exp_date, puspakom, image) VALUES ('$regnum', '$make', '$model', '$yearmanufactured', '$yearregistered', '$roadtaxexpdate', '$insuranceexpdate', '$puspakom', '$image')";

    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["create"] = "Vehicle Added Successfully";
        header("Location: index.php");
        exit(); // Ensure no further code is executed
    } else {
        die("Something went wrong");
    }
}

if (isset($_POST["edit"])) {
    $id = mysqli_real_escape_string($conn, $_POST["vehicle_id"]);

    // Retrieve current values from the database
    $sql = "SELECT * FROM vehicles WHERE vehicle_id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    // Get the submitted values
    $regnum = mysqli_real_escape_string($conn, $_POST["regnum"]);
    $make = mysqli_real_escape_string($conn, $_POST["make"]);
    $model = mysqli_real_escape_string($conn, $_POST["model"]);
    $yearmanufactured = mysqli_real_escape_string($conn, $_POST["yearmanufactured"]);
    $yearregistered = mysqli_real_escape_string($conn, $_POST["yearregistered"]);
    $roadtaxexpdate = mysqli_real_escape_string($conn, $_POST["roadtaxexpdate"]);
    $insuranceexpdate = mysqli_real_escape_string($conn, $_POST["insuranceexpdate"]);
    $puspakom = mysqli_real_escape_string($conn, $_POST["puspakom"]);
    $image = $row['image']; // Default to current image

    // Ensure the uploads directory exists
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Handle file upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
            // Optionally, delete the old image file
            if (file_exists($row['image'])) {
                unlink($row['image']);
            }
        } else {
            die("Error uploading file.");
        }
    }

    // Initialize an array to hold the update queries
    $updates = [];

    // Compare each field and add to the update array if changed
    if ($regnum != $row['reg_number']) {
        $updates[] = "reg_number='$regnum'";
    }
    if ($make != $row['make']) {
        $updates[] = "make='$make'";
    }
    if ($model != $row['model']) {
        $updates[] = "model='$model'";
    }
    if ($yearmanufactured != $row['year_manufactured']) {
        $updates[] = "year_manufactured='$yearmanufactured'";
    }
    if ($yearregistered != $row['year_registered']) {
        $updates[] = "year_registered='$yearregistered'";
    }
    if ($roadtaxexpdate != $row['roadtax_exp_date']) {
        $updates[] = "roadtax_exp_date='$roadtaxexpdate'";
    }
    if ($insuranceexpdate != $row['insurance_exp_date']) {
        $updates[] = "insurance_exp_date='$insuranceexpdate'";
    }
    if ($puspakom != $row['puspakom']) {
        $updates[] = "puspakom='$puspakom'";
    }
    if ($image != $row['image']) {
        $updates[] = "image='$image'";
    }

    // Construct the update query
    if (!empty($updates)) {
        $sql = "UPDATE vehicles SET " . implode(", ", $updates) . " WHERE vehicle_id=$id";
        if (mysqli_query($conn, $sql)) {
            session_start();
            $_SESSION["create"] = "Vehicle Updated Successfully";
            header("Location: index.php");
            exit(); // Ensure no further code is executed
        } else {
            die("Something went wrong");
        }
    } else {
        echo "No changes detected.";
    }

    mysqli_close($conn);
}
