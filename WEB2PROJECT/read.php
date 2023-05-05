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
    <link rel="stylesheet" href="read.css">
    <script style="display:none;">

        $(document).ready(function () {
            $(".resName").hover(function () {
                $(this).css("color", "#161d6f");
            },
                function () {
                    $(this).css("color", "#000000");
                });
        })

        function updateMe(rName) {
            restaurantName = rName.innerHTML;
            document.getElementById("tbSearch").value = restaurantName;
            document.getElementById("myForm").submit();
        }
    </script>
</head>

<body>
    <!--=============== Main Container ===============-->
    <div class="container" id="container">

        <!--=============== Sidebar ===============-->
        <div class="sidebar" id="sidebar">
            <div class="menuBar">
                <div class="profile">

                </div>

                <ul>
                    <li class="activeLink">
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
                    <li>
                        <img src="icons/delete.png" style=width="40px" height="40px"></img>
                        <a href="delete.php">Delete</a>
                    </li>
                </ul>

            </div>
        </div>

        <!--=============== Main ===============-->
        <div class="main" id="main">

            <!--=============== Header ===============-->
            <div class="header" id="header">
                <div class="greeting">
                    <h1>Welcome to<br>Buffet Boulevard !</h1>
                </div>

                <div class="searchbox">
                    <form method="post" action="read.php" id="myForm">
                        <input type="text" placeholder="Search" list="options" name="Search" id="tbSearch"
                            oninput="showHint(this.value)">
                        <i class="ri-search-line ri"></i>
                </div>
            </div>
            <img src='icons/back.png' onclick=location.href="home.php" height='40px' width='40px'>
            <div class="item" id="item">
                <div class="box">
                    <?php
                    $xml = new domDocument("1.0");
                    $xml->load("BSIT3EG1G5.xml");
                    $search = strtolower($_POST["Search"]);
                    $buffets = $xml->getElementsByTagName("buffet");
                    foreach ($buffets as $buffet) {
                        $name = strtolower($buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue);
                        if ($search == $name) {
                            $flag = 1;
                            $restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
                            $basePrice = $buffet->getElementsByTagName("basePrice")->item(0)->nodeValue;
                            $serviceOptions = $buffet->getElementsByTagName("serviceOptions")->item(0)->nodeValue;
                            $location = $buffet->getElementsByTagName("location")->item(0)->nodeValue;
                            $openingHours = $buffet->getElementsByTagName("openingHours")->item(0)->nodeValue;
                            $googleReviewRatings = $buffet->getElementsByTagName("googleReviewRatings")->item(0)->nodeValue;
                            $picture = $buffet->getElementsByTagName("picture")->item(0)->nodeValue;

                            echo "<buffet>";
                            echo "<div class='itemCard'> ";
                            echo "<br><br><restaurantName class='Title'>" . "$restaurantName</restaurantName></br></br>";
                            echo "<img class = 'pic' src='data:image;base64," . $picture . "' height='400' width='400'><br><br>";
                            echo "<basePrice class='Title'>" . "$basePrice</basePrice><br>";
                            echo "<serviceOptions class='Title'>" . "$serviceOptions</serviceOptions><br>";
                            echo "<Location class='Title'>" . "$location</location><br>";
                            echo "<openingHours class='Title'>" . "$openingHours</openingHours><br>";
                            echo "<googleReviewRatings class='Title'>" . "$googleReviewRatings</googleReviewRatings><br>";
                            echo "</buffet>";
                            break;
                        }
                    }
                    if ($flag == 0)
                        echo "<h2 id='result'>No record found.</h2>";
                    ?>
                </div>
            </div>
</body>

</html>