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
    <link rel="stylesheet" href="css/delete.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="jquery/jquery-3.6.4.min.js"></script>
    <script style="display:none">


        $(document).ready(function () {
            $('input[type=submit], #btnDelete').hover(function () {
                $(this).css({
                    "background-color": "#3A3F70"
                })
            }, function () {
                $(this).css({
                    "background-color": "#161D6F"
                })
            })
        })
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
                    <li class="activeLink">
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
                    <form method="post" action="deleteProcess.php" id="myForm">
                        <input type="text" placeholder="Search" list="options" name="Search" id="tbSearch"
                            oninput="showHint(this.value)">
                        <i class="ri-search-line ri"></i>
                </div>
            </div>
            <div class="deleteCss">
            <img src='icons/back.png' onclick=location.href="home.php" height='40px' width='40px'>
            <input type='button' value='Delete' id='btnDelete' class='btn btn-primary' data-toggle='modal'
                data-target='#exampleModalCenter' height='40px' width='40px'>
                </div>
            <div class="item" id="item">
                <div class="box">
                    <?php
                    $xml = new domDocument("1.0");
                    $xml->load("BSIT3EG1G5.xml");
                    $flag = 0;
                    $Search = strtolower($_POST["Search"]);
                    $_SESSION["Search"] = $Search;
                    $buffets = $xml->getElementsByTagName("buffet");
                    foreach ($buffets as $buffet) {
                        $name = strtolower($buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue);
                        if ($Search == $name) {
                            $flag = 1;
                            $restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
                            $basePrice = $buffet->getElementsByTagName("basePrice")->item(0)->nodeValue;
                            $serviceOptions = $buffet->getElementsByTagName("serviceOptions")->item(0)->nodeValue;
                            $location = $buffet->getElementsByTagName("location")->item(0)->nodeValue;
                            $openingHours = $buffet->getElementsByTagName("openingHours")->item(0)->nodeValue;
                            $googleReviewRatings = $buffet->getElementsByTagName("googleReviewRatings")->item(0)->nodeValue;
                            $picture = $buffet->getElementsByTagName("picture")->item(0)->nodeValue;

                            echo "<buffet class='buffet'>";
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
        </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <form class="deleteForm" method="POST" action="deleteProcess.php">
                        <h5 class="modal-title" id="exampleModalLongTitle">Warning !</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure do you want to delete this data? <?php echo $Search; ?>
                </div>
                <div class="modal-footer">
                    <input type="text" name="Search" id="rName" value="<?php echo $Search; ?>" style="display: none;">
                    <button type="button" id="btnOk" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnCancel" class="btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>