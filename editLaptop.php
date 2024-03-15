<?php
//Declaring array for RAM and Processor dropdown....
$arrayRAM = array("4 GB", "8 GB", "16 GB", "32 GB", "64 GB", "128 GB");
$arrayProcessor = array("Intel Core i3-1115G4", "Intel Core i5-1135G7", "Intel Core i7-1165G7","Intel Core i9-11980HK","AMD Ryzen 3 3250U","AMD Ryzen 5 4500U","AMD Ryzen 7 5800H","AMD Ryzen 9 5900HX");

//Starting session for error variables...
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Laptop Shop</title>
</head>
<body>
    <div class="text-center justify-items-center my-4">
        <button class="btn btn-danger px-4 py-2" onClick="location.href='index.php'">Go Back</button>
    </div>
    <div class="border border-dark rounded my-5 container-sm bg-white p-4">
    <?php
        //Imlorting database file...
        require('dbinit.php');

        //Getting ID which is sent as variable with link...
        $laptopID = $_GET['laptopID'];

        //Select query as per ID...
        $selectQuery=mysqli_query($connection,"SELECT * FROM laptops WHERE `laptopID` = '$laptopID' ");

        //Making array of data received...
        $data=mysqli_fetch_array($selectQuery);
    ?>

        <div class="text-center"><span class="fs-1 text-primary">Update Laptop</span></div>
        <!-- enctype is for uploading image -->
        <form class="m-3" method="POST" enctype="multipart/form-data" action="updateLaptop.php">
            <div class="row mb-3">
                <div class="col">
                    <label for="laptopBrand" class="form-label">Laptop Brand</label>
                    <!-- setting value as per data fetched -->
                    <input type="text" value="<?php echo $data['laptopBrand'];?>" class="form-control border border-dark" id="laptopBrand" name="laptopBrand">
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['brandError'])) { echo $_SESSION['brandError']; } ?></span>
                </div>
                <div class="col">
                    <label for="laptopName" class="form-label">Laptop Name</label>
                    <!-- setting value as per data fetched -->
                    <input type="text" value="<?php echo $data['laptopName'];?>" class="form-control border border-dark" id="laptopName" name="laptopName">
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['nameError'])) { echo $_SESSION['nameError']; } ?></span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="laptopRAM" class="form-label">Laptop RAM</label>
                    <select class="form-select border border-dark" id="laptopRAM" name="laptopRAM">
                        <option value="default">Select RAM</option>
                        <?php 
                            foreach($arrayRAM as $RAM)
                            {
                                //Checking if value fetched is same as array or not...
                                if($data['laptopRAM'] == $RAM)
                                {
                                    //If it will be same, then the option would be selected....
                                    echo "<option selected value='$RAM'>$RAM</option>";
                                }
                                else
                                {
                                    //If not same it will be added to dropdown...
                                    echo "<option value='$RAM'>$RAM</option>";
                                }
                            }
                        ?>  
                    </select>
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['RAMError'])) {echo $_SESSION['RAMError'];} ?></span>
                </div>
                <div class="col">
                    <label for="laptopProcessor" class="form-label">Laptop Processor</label>
                    <select class="form-select border border-dark" id="laptopProcessor" name="laptopProcessor">
                        <option value="default">Select Processor</option>
                        <?php 
                            foreach($arrayProcessor as $processor)
                            {
                                //Checking if value fetched is same as array or not...
                                if($data['laptopProcessor'] == $processor)
                                {
                                    //If it will be same, then the option would be selected....
                                    echo "<option selected value='$processor'>$processor</option>";
                                }
                                else
                                {
                                    //If not same it will be added to dropdown...
                                    echo "<option value='$processor'>$processor</option>";
                                }
                            }
                        ?>
                    </select>
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['processorError'])) {  echo $_SESSION['processorError'];  }?></span>
                </div>
            </div>
            <div class="mb-3">
                <label for="laptopDescription" class="form-label">Laptop Description</label>
                <!-- setting value as per data fetched -->
                <textarea class="form-control border border-dark" id="laptopDescription" name="laptopDescription" rows="7" cols="30"><?php echo $data['laptopDescription'];?></textarea>
                <!-- If session of error will be set then it will be displayed...  -->
                <span class="text-danger fw-bold"><?php if(isset($_SESSION['descriptionError']))  { echo $_SESSION['descriptionError']; } ?></span>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="quantityAvailable" class="form-label">Quantity Available</label>
                    <!-- setting value as per data fetched -->
                    <input type="number" value="<?php echo $data['quantityAvailable'];?>" class="form-control border border-dark" id="quantityAvailable" name="quantityAvailable">
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['quantityError'])) { echo $_SESSION['quantityError']; } ?></span>
                </div>
                <div class="col">
                    <label for="laptopPrice" class="form-label">Laptop Price</label>
                    <!-- setting value as per data fetched -->
                    <input type="text" value="<?php echo $data['laptopPrice'];?>" class="form-control border border-dark" id="laptopPrice" name="laptopPrice">
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['priceError'])) { echo $_SESSION['priceError']; } ?></span>                
                </div>
            </div>
            <div class="mb-3">
                <label for="laptopImage" class="form-label">Laptop Image</label><br>
                <!-- setting value as per data fetched -->
                <img src="<?php echo $data['laptopImage'];?>" height="120px" width="200px">
                <input type="file" class="form-control border border-dark" id="laptopImage" name="laptopImage">
                <span class="text-danger fw-bold">If you will not change image it will be remain same as previous image...</span>
            </div>
            <input type="hidden" id="laptopID" name="laptopID" value="<?php echo $data['laptopID']; ?>">
            <div class="text-center">
                <!-- update button -->
                <button type="submit" class="btn btn-primary mt-4 px-5" id="updateBtn" name="updateBtn">Update</button>
            </div>
        </form>
    </div>
</body>
</html>