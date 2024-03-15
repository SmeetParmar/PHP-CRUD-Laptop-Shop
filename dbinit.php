<?php

//test connection without database....
$testConnection = mysqli_connect("localhost","root","");

//checking if database exist or not using show database like query of MySQL...
//It will return number of data fetched...
$checkDatabase = mysqli_query($testConnection,"show databases like 'assignment'");

//It will return 0 if no database is found...
if(MYSQLI_NUM_ROWS($checkDatabase) == 0)
{
    //Creating the database...
    mysqli_query($testConnection,"Create database IF NOT EXISTS `assignment`");
    echo "<script>alert('Database Created Successfully...')</script>";
}

//New connection with database...
$connection = mysqli_connect("localhost","root","","assignment");

//checking if table exist or not using show tables like query of MySQL...
//It will return number of data fetched...
$checkTable = mysqli_query($connection,"show tables like 'laptops'");

//It will return 0 if no table is found...
if(MYSQLI_NUM_ROWS($checkTable) == 0)
{
    //Creating laptops table...
    mysqli_query($connection,"CREATE TABLE IF NOT EXISTS `laptops` (
        `laptopID` int(11) NOT NULL AUTO_INCREMENT,
        `laptopName` varchar(255) NOT NULL,
        `laptopDescription` longtext NOT NULL,
        `laptopBrand` varchar(255) NOT NULL,
        `laptopProcessor` varchar(255) NOT NULL,
        `laptopRAM` varchar(255) NOT NULL,
        `quantityAvailable` int(11) NOT NULL,
        `laptopPrice` varchar(255) NOT NULL,
        `laptopImage` varchar(255) NOT NULL,
        `laptopAddedBy` varchar(255) NOT NULL,
        PRIMARY KEY (`laptopID`)
      )");

    echo "<script>alert('Table Created Successfully...')</script>";

      //Inserting the data to table...
      mysqli_query($connection,"INSERT INTO `laptops` (`laptopID`, `laptopName`, `laptopDescription`, `laptopBrand`, `laptopProcessor`, `laptopRAM`, `quantityAvailable`, `laptopPrice`, `laptopImage`, `laptopAddedBy`) VALUES
      (5, 'Inspiron 16', 'The Dell Inspiron 16 is a powerful laptop featuring a 16-inch display, delivering immersive visuals. It is equipped with high-performance processors, ample storage options, and a sleek design. Ideal for both work and entertainment, this laptop provides a seamless computing experience with its impressive specifications and large display.', 'Dell', 'Intel Core i9-11980HK', '64 GB', 100, '789.89$', 'uploads/dell.jpg', 'Smeet Parmar'),
      (6, 'Latitude 2', 'Dell Latitude laptops are renowned for their reliability and security, catering to business professionals. With durable designs, advanced manageability features, and robust security options, Latitude series offers a balance of performance and productivity. These laptops are ideal for professionals seeking efficient, secure, and reliable..', 'Dell', 'AMD Ryzen 5 4500U', '32 GB', 60, '999.99$', 'uploads/dell2.jpg', 'Smeet Parmar'),
      (7, 'MacBook', 'The MacBook, crafted by Apple, is a premium laptop series renowned for its elegant design, high-resolution Retina displays, and efficient macOS operating system. Available in various models, including the ultra-portable MacBook Air and powerful MacBook Pro, these laptops combine cutting-edge technology with sleek aesthetics.', 'Apple', 'Intel Core i3-1115G4', '4 GB', 10, '1099.99$', 'uploads/apple.jpg', 'Smeet Parmar'),
      (8, 'MacBook Air Pro', 'The MacBook Air, Apple\'s ultraportable laptop, is celebrated for its slim design, Retina display, and all-day battery life. The MacBook Pro, designed for professionals, boasts powerful performance, a stunning Retina display, and advanced features such as the Touch Bar. Both models showcase Apple\'s commitment to innovation, style, and user experience.', 'Apple', 'Intel Core i9-11980HK', '64 GB', 20, '1199.89$', 'uploads/apple2.jpg', 'Smeet Parmar'),
      (9, 'ZenBook', 'The Asus ZenBook series represents a line of premium ultrabooks known for their sleek designs, high-quality build, and powerful performance. ZenBooks often feature ultra-slim profiles, vivid displays with thin bezels, and innovative technologies. These laptops are designed for professionals and users seeking a perfect balance of style, portability, and productivity.', 'Asus', 'AMD Ryzen 7 5800H', '32 GB', 35, '899.59$', 'uploads/asus2.jpg', 'Smeet Parmar'),
      (10, 'TUF Gaming Laptop', 'The Asus TUF Gaming series is tailored for gamers seeking a blend of performance, durability, and affordability. TUF Gaming laptops feature robust construction, military-grade durability, and high-performance components to deliver an immersive gaming experience. With powerful graphics, efficient cooling systems, and gaming-centric designs, TUF Gaming laptops cater to gamers.', 'Asus', 'AMD Ryzen 9 5900HX', '128 GB', 89, '1599.99$', 'uploads/asus.jpg', 'Smeet Parmar'),
      (11, 'Legion', 'The Lenovo Legion series is dedicated to gaming laptops, known for delivering high-performance hardware and features tailored for gamers. Legion laptops boast powerful processors, advanced graphics, and innovative cooling systems to enhance gaming experiences. With a focus on durability and design, Legion caters to gamers who demand cutting-e\dge technology and reliability for an immersive gaming environment.', 'Lenovo', 'Intel Core i9-11980HK', '64 GB', 30, '1299.19$', 'uploads/lenovo.jpg', 'Smeet Parmar'),
      (12, 'Yoga', 'the functionality of a laptop with the flexibility of a tablet. Yoga laptops feature hinges that allow for various modes, such as laptop, tent, stand, and tablet, providing users with adaptable form factors to suit different tasks and preferences. Renowned for their sleek aesthetics, premium build quality, and touchscreen displays, Yoga laptops offer a balance of style and versatility for users seeking a multi-functional computing experience.\r\n', 'Lenovo', 'Intel Core i7-1165G7', '32 GB', 40, '899.19$', 'uploads/lenovo2.jpg', 'Smeet Parmar'),
      (14, 'Pavilion', 'The HP Pavilion series encompasses a diverse range of laptops designed for various consumer needs. Known for its versatility, Pavilion laptops offer a mix of style, performance, and affordability. With options spanning from budget-friendly models to mid-range configurations, Pavilion laptops cater to users seeking reliable everyday computing devices with a balance of features and value at budget friendly price.', 'HP', 'Intel Core i9-11980HK', '64 GB', 58, '1499.89$', 'uploads/hp.jpg', 'Smeet Parmar')");

      echo "<script>alert('Data Inserted Successfully....')</script>";
}    

?>