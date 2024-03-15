<?php
//Starting session for error variables...
session_start();

//Confirming if updateBtn is clicked...
if(isset($_POST['updateBtn']))
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

    //Checking if all errors are empty then performing update operation...
    if($_SESSION['brandError']=="" && $_SESSION['nameError']=="" && $_SESSION['RAMError']=="" && $_SESSION['processorError']=="" && $_SESSION['descriptionError']=="" && $_SESSION['quantityError']=="" && $_SESSION['priceError']=="")
    {
        //Importing database file...
        require('dbinit.php');

        //Defining laptopID variable which is sent as hidden field from update form and hard coded variable for laptopAddedBy Column...
        $laptopID=$_POST['laptopID'];
        $laptopAddedBy = "Smeet Parmar";

        //Checking if laptopImage is image is uploaded or not using isset($_FILES) and there are no errors uploading it....
        if(isset($_FILES['laptopImage']) && $_FILES['laptopImage']['error'] == UPLOAD_ERR_OK)
        {
            //if image will be uploaded then, update query with updating image....
            $updateQuery = "UPDATE laptops SET laptopName = ?, laptopDescription = ?, laptopBrand = ?, laptopProcessor = ?, laptopRAM = ?, quantityAvailable = ?, laptopPrice = ?, laptopImage = ?,laptopAddedBy= ? WHERE laptopID = ?;";
        
            //Saving the uploaded image file to uploads folder using move_uploaded_file() php function...
            $filename=$_FILES["laptopImage"]["name"];
            $tempname=$_FILES["laptopImage"]["tmp_name"];
            $path="uploads/".$filename;
            move_uploaded_file($tempname,$path);

            //Preparing statement...
            $prepareStatement = mysqli_prepare($connection, $updateQuery);
        
            //Binding values...
            mysqli_stmt_bind_param(
                $prepareStatement,
                'sssssissss', 
                $laptopName, 
                $laptopDescription, 
                $laptopBrand, 
                $laptopProcessor, 
                $laptopRAM, 
                $quantityAvailable, 
                $laptopPrice, 
                $path,
                $laptopAddedBy,
                $laptopID
            );
        }
        else
        {
            //if image is not uploaded then, update query without updating image....
            $updateQuery = "UPDATE laptops SET laptopName = ?, laptopDescription = ?, laptopBrand = ?, laptopProcessor = ?, laptopRAM = ?, quantityAvailable = ?, laptopPrice = ?, laptopAddedBy= ? WHERE laptopID = ?;";

            //Preparing statement...
            $prepareStatement = mysqli_prepare($connection, $updateQuery);
        
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
                $laptopAddedBy,
                $laptopID
            );
        }
    
        //Executing the update query....
        if(mysqli_stmt_execute($prepareStatement))
        {
             //If query will be executed successfully, redirecting to index page...
            echo "<script>alert(`Data Updated Successfully...`);</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
        else
        {
            //If there is error executing query, redirecting to previous page i.e. to updateLaptop.php...
            echo "<script>alert(`Error Updating Data...`);</script>";
            echo "<script>window.history.back()</script>";
        }
        
     }
     //If any session would not be empty, following error will be shown and will be redirected to update laptop form page...
    else
    {
        echo "<Script>alert('Insert valid data...')</Script>";
        echo "<script>window.history.back()</script>";
    }
}

?>