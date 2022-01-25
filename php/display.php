<?php
 include 'dbconnect.php';
 $sqldata = "SELECT * FROM `table_product` ORDER BY id DESC";

 $results_per_page= 10;
 if (isset($_GET['pagenum'])) {
     $pagenum = (int)$_GET['pagenum'];

     $page_first = ($pagenum - 1) * $results_per_page;
  } else {
         $pagenum =1;
         $page_first = ($pagenum - 1) * $results_per_page;
     }

 $stmt = $conn->prepare($sqldata);
 $stmt->execute();
 $result_num = $stmt->rowCount();
 $num_page = ceil($result_num / $results_per_page);

 $stmt = $conn->prepare($sqldata);
 $stmt->execute();
 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
 $rows = $stmt->fetchAll();

 ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--ViewPort-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!--W3css References-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script scr="../javascript/script.js"></script>
    <style>
        body,html {height: 100%;}
        body,h1,h2,h3,h4,h5,h6 {font-family: 'Times New Roman', Georgia, serif;}
        
        @media screen and (min-width: 1920px) {
            body {
                max-width: 60%;
                margin: auto;
            }
        }
    </style>
    <title>Dainty Bites</title>
</head>
<body>
    <!--Navbar on top-->
 <div class ="w3-bar w3-sand w3-padding w3-card" style="letter-spacing: 3px;">
        <a href="mainpage.php" class="w3-bar-item w3-button">Dainty Bites</a>
        <a href="#logout" class="w3-bar-item w3-button w3-hide-small w3-right">Logout</a>
        <a href="addedproduct.php" class="w3-bar-item w3-button w3-hide-small w3-right">Add Product</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>


   <!--Right-sided navbar Dropdown menu. Shows on small screen-->
<div id="idnavbar" class="w3-bar-block w3-sand w3-hide w3-hide-large w3-hide-medium">
        <a href="#logout" class="w3-bar-item w3-button w3-center">Logout</a>
        <a href="addedproduct.php" class="w3-bar-item w3-button w3-center">Add Product</a>
    </div>
    <div class="w3-container w3-padding-16">
    </div>

    <div class="w3-center w3-padding-32 w3-dark-grey">
        <h1><strong>LIST OF PRODUCT</strong></h1>
</div>

<div class="w3-grid-template">
        <?php
        foreach ($rows as $customer) {
            $name = $customer['name'];
            $description = $customer['description'];
            $price = $customer['price'];
            $quantity = $customer['quantity'];
            echo "<div class='w3-center w3-padding'>";
            echo "<div class='w3-card-4 w3-dark-grey'>";
            echo "<header class='w3-container w3-sand'";
            echo "<h5><strong>$name</h5>";
            echo "</header>";
            echo "<div class='w3-padding'><img class='w3-image' src=../res/images/$name.png" .
            " onerror=this.onerror=null;this.src='../res/images/profile.png'"
            . " '></div>";
        echo "<div class='w3-container w3-left-align'><hr>";
            echo "<p><i class='fa fa-id-card' style='font-size:16px'>
            </i>&nbsp&nbsp$description<br>
            <i class='fa fa-money' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$price<br>
            <i class='fa fa-dropbox' style='font-size:16px'>
            </i>&nbsp&nbsp&nbsp&nbsp$quantity<br>";
             echo "</div>";
             echo "</div>";
             echo "</div>";
         }
         ?>
         </div>

         <?php
         $num = 1;
         if ($pagenum == 1) {
             $num = 1;
         } else if ($pagenum == 2) {
             $num = ($num) + $results_per_page;
         } else {
             $num = $pagenum * $results_per_page - 6;
         }
         echo "<div class='w3-container w3-row'>";
         echo "<center>";
         for ($page = 1; $page <= $num_page; $page++) {
             echo '<a href = "main.php?pageno=' . $page . '" style=
             "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
         }
         echo " ( " . $pagenum . " )";
         echo "</center>";
         echo "</div>";
         ?>
     
     <!--Footer-->

<footer class="w3-footer w3-center w3-sand">
    <p>Copyright: Dainty Bites</p>
</footer>
        </body>
        </html>
