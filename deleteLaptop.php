<?php
    //Importing database file...
    require('dbinit.php');

    //Getting variable from value sent with link...
    $ID = $_GET['laptopID'];

    //Delete query...
    if(mysqli_query($connection,"DELETE FROM `laptops` WHERE `laptopID` = '$ID'"))
    {
        //If successfully deleted the data...
        echo "<script>alert('Data Deleted Successfully...')</script>";
    }
    else
    {
        //If there is any error deleting data...
        echo "<script>alert('Error Deleting Data...')</script>";
        
    }
    //redirecting to index.php...
    echo "<script>window.location = 'index.php'</script>";
?>