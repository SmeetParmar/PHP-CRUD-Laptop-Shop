<?php
//Declaring array for RAM and Processor dropdown....
$arrayRAM = array("4 GB", "8 GB", "16 GB", "32 GB", "64 GB", "128 GB");
$arrayProcessor = array("Intel Core i3-1115G4", "Intel Core i5-1135G7", "Intel Core i7-1165G7","Intel Core i9-11980HK","AMD Ryzen 3 3250U","AMD Ryzen 5 4500U","AMD Ryzen 7 5800H","AMD Ryzen 9 5900HX");

//Starting session for error variables...
session_start();

//Checking if the request is SELF_POST...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //Confirming if addBtn is clicked...
    if(isset($_POST['addBtn']))
    {
        //Importing validation file...
        require('validations.php');

        //Checking if laptopBrand is empty or not using isEmpty() function defined in validations.php....
        if(isEmpty($_POST['laptopBrand']))
        {
            //If brand will be empty, following error will be shown...
            $_SESSION['brandError'] = "Brand Is required...";
        }
        //Checking if brand has special characters or digits using containsDigits() and containsSpecialCharacters() function defined in validations.php...
        elseif(!containsDigits($_POST['laptopBrand']) || !containsSpecialCharacters($_POST['laptopBrand']))
        {
            //If brand has special chars or digits, following error will be shown...
            $_SESSION['brandError'] = "Brand should not contain special characters or digits...";
        }
        //If brand will be correct, then assigning it to variable and making its associated error empty.....
        else
        {
            $laptopBrand = $_POST['laptopBrand'];
            $_SESSION['brandError'] = "";
        }

        //Checking if laptopName is empty or not using isEmpty() function defined in validations.php....
        if(isEmpty($_POST['laptopName']))
        {
            //If name will be empty, following error will be shown...
            $_SESSION['nameError'] = "Name Is required...";
        }
        //Checking if name has special characters using containsSpecialCharacters() function defined in validations.php...
        elseif(!containsSpecialCharacters($_POST['laptopName']))
        {
            //If name has special chars, following error will be shown...
            $_SESSION['nameError'] = "Name should not contain special characters...";
        }
        //If name will be correct, then assigning it to variable and making its associated error empty.....
        else
        {
            $laptopName = $_POST['laptopName'];
            $_SESSION['nameError'] = "";
        }

        //Checking if laptopRAM is selected or not using value of default selected item....
        if($_POST['laptopRAM'] == 'default')
        {
            //If RAM is not selected, following error will be shown...
            $_SESSION['RAMError'] = "Please Select a RAM...";
        }
        //If RAM will be selected, then assigning it to variable and making its associated error empty.....
        else
        {
            $laptopRAM = $_POST['laptopRAM'];
            $_SESSION['RAMError'] = "";
        }

        //Checking if laptopProcessor is selected or not using value of default selected item....
        if($_POST['laptopProcessor'] == 'default')
        {
            //If processor is not selected, following error will be shown...
            $_SESSION['processorError'] = "Please Select a Processor...";
        }
        //If Processor will be correct, then assigning it to variable and making its associated error empty.....
        else
        {
            $laptopProcessor = $_POST['laptopProcessor'];
            $_SESSION['processorError'] = "";
        }

        //Checking if laptopDescription is empty or not using isEmpty() function defined in validations.php....
        if(isEmpty($_POST['laptopDescription']))
        {
            //If description will be empty, following error will be shown...
            $_SESSION['descriptionError'] = "Description Is required...";
        }
        //If description will be correct, then assigning it to variable and making its associated error empty.....
        else
        {
            $laptopDescription = $_POST['laptopDescription'];
            $_SESSION['descriptionError'] = "";
        }

        //Checking if quantityAvailabe is empty or not using isEmpty() function defined in validations.php....
        if(isEmpty($_POST['quantityAvailable']))
        {
            //If quantity will be empty, following error will be shown...
            $_SESSION['quantityError'] = "Quantity Is required...";
        }
        //Checking if quantity is negative or not using validQuantity() function defined in validations.php...
        elseif(validQuantity($_POST['quantityAvailable']))
        {
            //If quantity will be negative following error will be shown...
            $_SESSION['quantityError'] = "Please Enter A Non Negative Quantity...";
        }
        //If quantity will be correct, then assigning it to variable and making its associated error empty.....
        else
        {
            $quantityAvailable = $_POST['quantityAvailable'];
            $_SESSION['quantityError'] = "";
        }

        //Checking if laptopPrice is empty or not using isEmpty() function defined in validations.php....
        if(isEmpty($_POST['laptopPrice']))
        {
            //If price will be empty, following error will be shown...
            $_SESSION['priceError'] = "Price Is required...";
        }
        //Checking if price is appropriate or not i.e. in XXX.XX$ or XXXX.XX$ formate using validPrice() function defined in validations.php... 
        elseif(validPrice($_POST['laptopPrice']))
        {
            //If price is not valid, following error will be shown...
            $_SESSION['priceError'] = "Please Enter Price in XXX.XX$ Or XXXX.XX$ format...";
        }
        //If price will be correct, then assigning it to variable and making its associated error empty.....
        else
        {
            $laptopPrice = $_POST['laptopPrice'];
            $_SESSION['priceError'] = "";
        }

        //Checking if laptopImage is image is uploaded or not using isset($_FILES) and there are no errors uploading it....
        if(isset($_FILES['laptopImage']) && $_FILES['laptopImage']['error'] == UPLOAD_ERR_OK)
        {
            //If image is uploaded, then making its associated error empty.....
            $_SESSION['imageError'] = "";
        }
        else
        {
            //If image is not uploaded, following error will be shown...
            $_SESSION['imageError'] = "Please Upload The Image...";
        }

        //Checking if all errors are empty then performing insert operation...
        if($_SESSION['brandError']=="" && $_SESSION['nameError']=="" && $_SESSION['RAMError']=="" && $_SESSION['processorError']=="" && $_SESSION['descriptionError']=="" && $_SESSION['quantityError']=="" && $_SESSION['imageError']=="" && $_SESSION['priceError']=="")
        {
            //Importing database file...
            require('dbinit.php');

            //Defining hard coded variable for laptopAddedBy Column...
            $laptopAddedBy = "Smeet Parmar";

            //Query for inserting data...
            $insertQuery = "INSERT INTO laptops(laptopName , laptopDescription, laptopBrand, laptopProcessor, laptopRAM, quantityAvailable, laptopPrice, laptopImage, laptopAddedBy) VALUES (?,?,?,?,?,?,?,?,?)";
            
            //Saving the uploaded image file to uploads folder using move_uploaded_file() php function...
            $filename=$_FILES["laptopImage"]["name"];
            $tempname=$_FILES["laptopImage"]["tmp_name"];
            $path="uploads/".$filename;
            move_uploaded_file($tempname,$path);

            //Preparing statement...
            $prepareStatement = mysqli_prepare($connection, $insertQuery);
        
            //Binding values...
            mysqli_stmt_bind_param(
                $prepareStatement,
                'sssssisss', 
                $laptopName, 
                $laptopDescription, 
                $laptopBrand, 
                $laptopProcessor, 
                $laptopRAM, 
                $quantityAvailable, 
                $laptopPrice, 
                $path,
                $laptopAddedBy
            );
            
        
            //Executing the insert query....
            if(mysqli_stmt_execute($prepareStatement))
            {
                //If query will be executed successfully, redirecting to index page...
                echo "<script>alert(`Data Inserted Successfully...`);</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
            else
            {
                //If there is error executing query, redirecting to previous page i.e. to addLaptop.php...
                echo "<script>alert(`Error Inserting Data...`);</script>";
                echo "<script>window.history.back()</script>";
            }
    }
    //If any session would not be empty, following error will be shown and will be redirected to add laptop form page...
    else
    {
        echo "<Script>alert('Insert valid data...')</Script>";
        echo "<script>window.history.back()</script>";
    }
}
}
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
    <div id="main-div" class="border border-dark rounded my-5 container-sm bg-white p-4">
        <div class="text-center"><span class="fs-1 text-primary">Add Laptop</span></div>
        
        <form class="m-3" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row mb-3">
                <div class="col">
                    <label for="laptopBrand" class="form-label">Laptop Brand</label>
                    <input type="text" class="form-control border border-dark" id="laptopBrand" name="laptopBrand">
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['brandError'])) { echo $_SESSION['brandError']; } ?></span>
                </div>
                <div class="col">
                    <label for="laptopName" class="form-label">Laptop Name</label>
                    <input type="text" class="form-control border border-dark" id="laptopName" name="laptopName">
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
                                echo "<option value='$RAM'>$RAM</option>";
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
                                echo "<option value='$processor'>$processor</option>";
                            }
                        ?>
                    </select>
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['processorError'])) {  echo $_SESSION['processorError'];  }?></span>
                </div>
            </div>
            <div class="mb-3">
                <label for="laptopDescription" class="form-label">Laptop Description</label>
                <textarea class="form-control border border-dark" id="laptopDescription" name="laptopDescription" rows="7" cols="30"></textarea>
                <!-- If session of error will be set then it will be displayed...  -->
                <span class="text-danger fw-bold"><?php if(isset($_SESSION['descriptionError']))  { echo $_SESSION['descriptionError']; } ?></span>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="quantityAvailable" class="form-label">Quantity Available</label>
                    <input type="number" class="form-control border border-dark" id="quantityAvailable" name="quantityAvailable">
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['quantityError'])) { echo $_SESSION['quantityError']; } ?></span>
                </div>
                <div class="col">
                    <label for="laptopPrice" class="form-label">Laptop Price</label>
                    <input type="text" class="form-control border border-dark" id="laptopPrice" name="laptopPrice">
                    <!-- If session of error will be set then it will be displayed...  -->
                    <span class="text-danger fw-bold"><?php if(isset($_SESSION['priceError'])) { echo $_SESSION['priceError']; } ?></span>                
                </div>
            </div>
            <div class="mb-3">
                <label for="laptopImage" class="form-label">Laptop Image</label>
                <input type="file" class="form-control border border-dark" id="laptopImage" name="laptopImage">
                <!-- If session of error will be set then it will be displayed...  -->
                <span class="text-danger fw-bold"><?php if(isset($_SESSION['imageError'])) { echo $_SESSION['imageError']; } ?></span>
            </div>
            <div class="text-center mt-4">
                <!-- add button -->
                <button type="submit" class="btn btn-primary px-5" id="addBtn" name="addBtn">Add</button>
            </div>
        </form>
    </div>
</body>
</html>

