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
    <link rel="stylesheet" href="css/add.css">
    <link rel="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery.min.js"></script>
    <script src="jquery/jquery-3.6.4.min.js"></script>
    <script style="display:none;">
        $(document).ready(function () {
            $("[type='checkbox']").change(function () {
                var choice = [];
                $("[type='checkbox']:checked").each(function () {
                    choice.push(this.value);
                });
                $("#selected").html("Current Service Option(s): " + choice);
            })
        })
        function validateForm() {
            const checkboxes = document.getElementsByName("serviceSelection[]");
            let checked = false;
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checked = true;
                    break;
                }
            }
            if (!checked) {
                alert("Please check at least one checkbox");
                return false;
            }
        }
        function getChecked() {
            let checkboxes = document.getElementsByName("serviceSelection");
            let checked = "";
            for (check of checkboxes) {
                if (check.checked) {
                    if (checked == "") {
                        checked = check.value;
                    } else {
                        checked = checked + ", " + check.value;
                    }
                }
            }
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
        function check() {
            var rName = document.getElementById("rName").value;
            if (rName.length == 0) {
                document.getElementById("prompt").innerHTML = "";
            } else {
                var http = new XMLHttpRequest();
                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (http.responseText == "This record already exists!") {
                            document.getElementById("prompt").innerHTML = http.responseText;
                            document.getElementById("prompt").style.display = "block";
                            document.getElementById("prompt").style.color = "#FF0000";
                            document.getElementById("add").disabled = true;
                            document.getElementById("add").style.backgroundColor = "#808080";
                            document.getElementById("add").style.cursor = "not-allowed"
                        } else if (http.responseText == "This record can be used") {
                            document.getElementById("prompt").innerHTML = http.responseText;
                            document.getElementById("prompt").style.display = "block";
                            document.getElementById("prompt").style.color = "#00FF00";
                            document.getElementById("add").disabled = false;
                            document.getElementById("add").style.backgroundColor = "#161d6f";
                            document.getElementById("add").style.cursor = "pointer"
                        } else {
                            document.getElementById("prompt").innerHTML = "";
                            document.getElementById("add").disabled = true;
                            document.getElementById("add").style.backgroundColor = "#808080";
                            document.getElementById("add").style.cursor = "not-allowed"
                        }
                    }
                };
                http.open("GET", "checkRestaurantName.php?rName=" + rName, true);
                http.send();
            }
        }
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

                    <li class="activeLink">
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
        <div class="main" id="main">
            <div class="header" id="header">
                <div class="greeting">
                    <h1>Welcome to<br>Buffet Boulevard !</h1>
                </div>
                <div class="searchbox">
                    <form method="post" action="read.php" id="myForm">
                        <input type="text" placeholder="Search" list="options" name="Search" id="tbSearch"
                            oninput="showHint(this.value)">
                        <i class="ri-search-line ri"></i>
                    </form>
                </div>
            </div>
            <div class="item" id="item">
                <div class="box">
                    <div class="itemCard">
                        <form method="POST" action="createRestaurantProcess.php" onsubmit="return validateForm()">
                            <h1>Add Restaurant</h1>
                            <label for="rName">Restaurant Name:</label>
                            <input type="text" id="rName" class ="form-control" name="restaurantName" onkeyup="check()" required />
                            <label for="rName" id="prompt" style="display: none; color: red;">prompt</label>
                            <br><label for="bPrice">Base Price:</label>
                            <input type="text" id="bPrice" class ="form-control" name="basePrice" required /></br>
                            <label for="sOption" style="display: inline;">Service Option:</label><br>
                            <label id="selected" style="display: inline; color:#FF0000;">Selected Service Option(s):
                                &nbsp; </label>
                            <br><br>
                            <div style="display: flex; align-items: center;">
                                <input style="width:fit-content;" id="cb1" type="checkbox" name="serviceSelection[]"
                                    value="Dine-in" />
                                <label style="margin-left:10px;" for="cb1">Dine-in</label>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <input style="width:fit-content;" id="cb2" type="checkbox" name="serviceSelection[]"
                                    value="Take-out" />
                                <label style="margin-left:10px;" for="cb2">Take-Out</label>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <input style="width:fit-content;" id="cb3" type="checkbox" name="serviceSelection[]"
                                    value="Delivery" />
                                <label style="margin-left:10px;" for="cb3">Delivery</label>
                            </div>
                            </br>
                            <label for="location">Location:</label>
                            <input type="text" id="location" class ="form-control" name="location" required /></br>
                            <label for="oHours">Opening Hours:</label>
                            <input type="time" id="oHours" class ="form-control" name="openingHours" required /><br>
                            <label for="gReviewRating">Google Review Rating:</label>
                            <input type="text" id="gReviewRating" class ="form-control" name="googleReviewRating" required /></br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="picture" id="inputGroupFile01"
                                        aria-describedby="inputGroupFileAddon01" required>
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            </br>
                            <input type="submit" name="Add" class="btn btn-primary btn-lg" id="add" value="ADD" />
                        </form>
                    </div>
                </div>
            </div>
</body>

</html>