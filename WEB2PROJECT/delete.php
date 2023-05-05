<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!--=============== Remix Icons cdn Link ===============-->
    <link rel="stylesheet" href="fonts/remixicon.css">

    <!--=============== Custom Css Link ===============-->
    <link rel="stylesheet" href="css/restaurant.css">
    <script src="jquery/jquery-3.6.4.min.js"></script>
    <script style="display:none;">
        	function deleteMe(rName) {
			restaurantName = rName.innerHTML;
			document.getElementById("tbSearch").value = restaurantName;
			document.getElementById("myForm").submit();
		}
        function showHint(name) {
            if (name.length == 0) {
                //document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                http = new XMLHttpRequest();
                http.onreadystatechange = function () {
                    if (http.readyState == 4 && http.status == 200) {
                        document.getElementById("options").innerHTML = http.responseText;
                    } else {

                    }
                };
                http.open("GET", "getNames.php?q=" + name, true);
                http.send();
            }
        }

        function revertStyle(element) {
            element.style.color = "#000000";
        }

        function changeStyle(element) {
            element.style.color = "#161d6f";
        }

        function deleteMe(rName) {
            restaurantName = rName.innerHTML;
            document.getElementById("tbSearch").value = restaurantName;
            document.getElementById("myForm").submit();
        }
        $('#toast').toast('hide')
    </script>
</head>

<body>

    <div class="container" id="container">

        <div class="sidebar" id="sidebar">
            <div class="menuBar">
                <ul>
                    <li>
                        <img src="icons/home.png" onclick="location.href='home.php'" style=width="40px"
                            height="40px"></img>
                        <a href="home.php">home</a>
                    </li>
                    <li>
                        <img src="icons/add.png" style=width="40px" height="40px"></img>
                        <a href="add.php">Add</a>
                    </li>
                    <li>
                        <img src="icons/update.png" style=width="40px" height="40px"></img>
                        <a href="update.php">Update</a>
                    </li>
                    <li  class="activeLink">
                        <img src="icons/delete.png" style=width="40px" height="40px"></img>
                        <a href="delete.php">Delete</a>
                    </li>
                </ul>

            </div>
        </div>


        <div class="main" id="main">


            <div class="header" id="header">
                <div class="greeting">
                    <h1>Welcome to<br>Buffet Boulevard !</h1>
                </div>

                <div class="searchbox">
                <form method="post" action="deleteSearch.php" id="myForm">
                        <input type="text" placeholder="Search" list="options" name="Search" id="tbSearch"
                            oninput="showHint(this.value)">
                            <datalist id="options">
                </div>

            </div>


            <div class="item" id="item">
                <div class="itemHeader">
                    <div class="tittle">
                        <h1>All Restaurant</h1>
                        <i class="ri-arrow-left-right-line ri"></i>
                    </div>
                </div>
                <div class="box">
                    <?php
                    $xml = new domDocument("1.0");
                    $xml->load("BSIT3EG1G5.xml");
                    $buffets = $xml->getElementsByTagName("buffet");
                    foreach ($buffets as $buffet) {
                        $count = 0;
                        $restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
                        $basePrice = $buffet->getElementsByTagName("basePrice")->item(0)->nodeValue;
                        $serviceOptions = $buffet->getElementsByTagName("serviceOptions")->item(0)->nodeValue;
                        $location = $buffet->getElementsByTagName("location")->item(0)->nodeValue;
                        $openingHours = $buffet->getElementsByTagName("openingHours")->item(0)->nodeValue;
                        $googleReviewRatings = $buffet->getElementsByTagName("googleReviewRatings")->item(0)->nodeValue;
                        $picture = $buffet->getElementsByTagName("picture")->item(0)->nodeValue;
                        $count++;

                        echo "<buffet>";
                        echo "<div class='itemCard'> ";
                        echo "<img src='data:image;base64," . $picture . "'height='90px' width='90px'><br><br></br><br>";
                        echo "<restaurantName class='tittle' onclick='deleteMe(this)' style='cursor:pointer;' onmouseover='changeStyle(this)' onmouseout='revertStyle(this)'>" . "$restaurantName</restaurantName></br><br>";
                        echo "<basePrice class='price'>" . "$basePrice</basePrice><br>";
                        echo "<i class='ri-heart-fill'></i>";
                        echo "</div>";
                        echo "</buffet>";

                    }
                    ?>
                </div>
            </div>
</body>

</html>