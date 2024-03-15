<?php
    //Importing database file...
    require('dbinit.php');

    //Selecting all data from database...
    $results = @mysqli_query($connection,"SELECT * FROM laptops");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Laptop Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="text-center justify-items-center my-4">
        <a href="addLaptop.php" class="btn btn-primary px-4 py-2">Add Laptop </a>
    </div>
    <div class="container">
        <div class="row d-flex align-items-center">
        <?php
            // Loop through data fetched and converting it to array...
            while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){ ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                <img src="<?php echo $row['laptopImage']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <!-- Laptop Brand and Name -->
                        <h5 class="card-title fs-4"><?php echo $row['laptopBrand']." ".$row['laptopName'] ?></h5>
                        <div class="row">
                            <div class="col-7">
                                <!-- Laptop Processor -->
                                <p class="card-text fw-bold fs-6"><?php echo $row['laptopProcessor']; ?></p>
                            </div>
                            <div class="col-5">
                                <!-- Laptop RAM -->
                                <p class="card-text fw-bold fs-6"><?php echo $row['laptopRAM']; ?></p>
                            </div>
                        </div>
                        <!-- Laptop Description -->
                        <p id="description" class="card-text my -2"><?php echo $row['laptopDescription']; ?></p>
                        <div class="row">
                            <div class="col-7">
                                <!-- Laptop Price -->
                                <p class="card-text fw-bold fs-6">Price <?php echo " : ".$row['laptopPrice']?></p>
                            </div>
                            <div class="col-5">
                                <!-- Laptop Stock -->
                                <p class="card-text fw-bold fs-6">Stock <?php echo " : ".$row['quantityAvailable']?></p>
                            </div>
                        </div>
                        <div class="text-center mt-3 mb-1">
                            <!-- edit record link with id... -->
                            <a href="editLaptop.php?laptopID=<?php echo $row['laptopID']?>" class="btn btn-primary">Update</a>
                            <!-- delete record link with id... -->
                            <a href="deleteLaptop.php?laptopID=<?php echo $row['laptopID']?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>