<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <?php
        include "header.php";
        ?>

</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h2>Add Vehicle</h2>
            <div>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </header>

        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="form-element my-4">
                <label for="exampleInputEmail1">Registration Number</label>
                <input type="text" class="form-control" name="regnum" placeholder="Registration Number">
            </div>
            <div class="form-element my-4">
                <label for="exampleInputMake1">Make/Manufacturer</label>
                <input type="text" class="form-control" name="make" placeholder="Make">
            </div>
            <div class="form-element my-4">
                <label for="exampleInputModel1">Model</label>
                <input type="text" class="form-control" name="model" placeholder="Model">
            </div>
            <div class="form-element my-4">
                <label for="exampleInputYearManufactered1">Year Manufactered (YYYY)</label>
                <input type="text" class="form-control" name="yearmanufactured" placeholder="Year Manufactured (YYYY-MM-DD)">
            </div>
            <div class="form-element my-4">
                <label for="exampleInputYearRegistered1">Year Registered (YYYY)</label>
                <input type="text" class="form-control" name="yearregistered" placeholder="Year Registered (YYYY-MM-DD)">
            </div>
            <div class="form-element my-4">
            <label for="exampleInputRoadtaxExpDate1">Roadtax Expiry Date (YYYY-MM-DD)</label>
                <input type="text" class="form-control" name="roadtaxexpdate" placeholder="Roadtax Expiry Date (YYYY-MM-DD)">
            </div>
            <div class="form-element my-4">
            <label for="exampleInputInsurancesExpDate1">Insurance Expiry Date (YYYY-MM-DD)</label>
                <input type="text" class="form-control" name="insuranceexpdate" placeholder="Insurance Expiry Date (YYYY-MM-DD)">
            </div>
            <div class="form-element my-4">
            <label for="exampleInputPuspakom1">Puspakom ('Passed' or 'Failed')</label>
                <input type="text" class="form-control" name="puspakom" placeholder="Puspakom">
            </div>
            <div class="form-element my-4">
                <input type="file" class="form-control" name="image">
            </div>
            <div class="form-element my-4">
                <input type="submit" class="btn btn-success" name="create" value="Add Vehicle">
            </div>
        </form>

    </div>

    <?php
        include "foot.php";
        ?>
        
</body>
</html>
