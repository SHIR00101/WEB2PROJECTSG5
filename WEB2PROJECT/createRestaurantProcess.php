<?php
    $xml = new domDocument("1.0");
    $xml ->formatOutput = true;
    $xml ->preserveWhiteSpace = false;
    $xml ->load("BSIT3EG1G5.xml");

    $restaurantName = $_POST["restaurantName"];
    $basePrice = $_POST["basePrice"];
    $serviceOptions = implode(", ", $_POST["serviceSelection"]);
    $location = $_POST["location"];
    $openingHours = $_POST["openingHours"];
    $googleReviewRatings = $_POST["googleReviewRating"];
    $picture = $_POST["picture"];

    $pic = $xml->createElement("picture");
    $image = "pictures/".$picture;
    $imageData = file_get_contents($image)  ;
    $base64 = base64_encode($imageData);
    $cdata = $xml ->createCDATASection($base64);

    $buffet = $xml -> createElement("buffet");
    $rName = $xml -> createElement("restaurantName",$restaurantName);
    $bPrice = $xml -> createElement("basePrice",$basePrice);
    $sOptions = $xml -> createElement("serviceOptions",$serviceOptions);
    $locations = $xml -> createElement("location", $location);
    $oHours = $xml -> createElement("openingHours", $openingHours);
    $gReviewRatings = $xml -> createElement("googleReviewRatings",$googleReviewRatings);
    $pic->appendChild($cdata);



    $buffet ->appendChild($rName);
    $buffet ->appendChild($bPrice);
    $buffet ->appendChild($sOptions);
    $buffet ->appendChild($locations);
    $buffet ->appendChild($oHours);
    $buffet ->appendChild($gReviewRatings);
    $buffet ->appendChild($pic);

    $xml -> getElementsByTagName("buffets") -> item(0)->appendChild($buffet);
    $xml -> save("BSIT3EG1G5.xml");
    echo "<script>window.location='home.php';
                    alert('Record saved!');
            </script>";
