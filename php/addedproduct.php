<?php
    
    if(isset($_POST["submit"])){
        include 'dbconnect.php';
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $sqlregister = "INSERT INTO `table_product`(`name`, `description`, `price`, `quantity`)
         VALUES('$name', '$description', '$price', '$quantity')";
    
        try{
            $conn->exec($sqlregister);
            if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){
                uploadImage($name);
                echo "<script>alert('Successfuly added')</script>";
                echo "<script>window.location.replace('display.php')</script>";
            }    
            
        }catch (PDOException $e) {
                echo"<script>alert('Failed to add')</script>";
                echo "<script>window.location.replace('addedproduct.php')</script>";
            }
    }

        function uploadImage($name){
            $target_dir = "../res/images/";
            $target_file = $target_dir . $name . ".png";
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-aswsome.min.css">
    <link rel="stylesheet" href="../res/images/profile.png">
    <link rel="stylesheet" href="style/style.css">
    <script src="../javascript/script.js"></script>
    <title>Add Product</title>
</head>


<body>
      <!--Navbar on top-->
      <div class ="w3-bar w3-sand w3-padding w3-card" style="letter-spacing: 3px;">
        <a href="display.php" class="w3-bar-item w3-button">Dainty Bites</a>
        <a href="#logout" class="w3-bar-item w3-button w3-hide-small w3-right">Logout</a>
        <a href="addproduct.php" class="w3-bar-item w3-button w3-hide-small w3-right">Add Product</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>

    <!--Right-sided navbar Dropdown menu. Shows on small screen-->
    <div id="idnavbar" class="w3-bar-block w3-sand w3-hide w3-hide-large w3-hide-medium">
        <a href="#logout" class="w3-bar-item w3-button w3-center">Logout</a>
        <a href="addproduct.php" class="w3-bar-item w3-button w3-center">Add Product</a>
    </div>

    <!--Add Product Form-->
    <div class="w3-container w3-padding-64 form-container">
        <div class="w3-card">
            <div class="w3-container w3-grey">
                <p>Add Product</p>
            </div>
            <form class="w3-container w3-padding " name="registerForm" action="addedproduct.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">
                <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image w3-round w3-margin"
                    src="../res/images/profile.png" style="width:100%;
                    max-width:600px"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload"
                    id="fileToUpload"><br>
                </div>

            <p>
                <label class="w3-text-black"><b>Product Name</b></label>
                <input class="w3-input w3-border w3-round" name="name" type="text" id="idname" required>
            </p>

            <p>
                <label class="w3-text-black"><b>Description</b></label>
                <input class="w3-input w3-border w3-round" name="description" type="text" id="iddescription" required>
            </p> 

            <p>
                <label class="w3-text-black"><b>Price</b></label>
                <input class="w3-input w3-border w3-round" name="price" type="text" id="idprice" required>
            </p>  

            <p>
                <label class="w3-text-black"><b>Quantity</b></label>
                <input class="w3-input w3-border w3-round" name="quantity" type="text" id="idquantity" required>
            </p> 

            <p>
                <button class='w3-btn w3-round w3-grey w3-block' name="submit">Add Product</button>
            </p>
    </form>
    </div>  
    </div>

<!--Footer-->

<footer class="w3-footer w3-center w3-sand">
    <p>Copyright: Dainty Bites</p>
</footer>

    </body>
</html>



