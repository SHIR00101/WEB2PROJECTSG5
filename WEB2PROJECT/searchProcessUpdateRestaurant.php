<?php
session_start();
?>
<?php
$xml = new domdocument("1.0");
$xml->load("BSIT3EG1G5.xml");
$buffets = $xml->getElementsByTagName("buffet");

$flag = 0;
$search = strtolower($_POST["Search"]);

foreach ($buffets as $buffet) {
	$trademark = strtolower($buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue);
	if (($search == $trademark) || ($search == $trademark)) {
		$flag = 1;
		$restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
		$basePrice = $buffet->getElementsByTagName("basePrice")->item(0)->nodeValue;
		$serviceOptions = $buffet->getElementsByTagName("serviceOptions")->item(0)->nodeValue;
		$location = $buffet->getElementsByTagName("location")->item(0)->nodeValue;
		$openingHours = $buffet->getElementsByTagName("openingHours")->item(0)->nodeValue;
		$googleReviewRatings = $buffet->getElementsByTagName("googleReviewRatings")->item(0)->nodeValue;
		$picture = $buffet->getElementsByTagName("picture")->item(0)->nodeValue;

		$trademark = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
		$_SESSION['restaurantName'] = $trademark;
		$_SESSION['basePrice'] = $basePrice;
		$_SESSION['serviceOptions'] = $serviceOptions;
		$_SESSION['location'] = $location;
		$_SESSION['openingHours'] = $openingHours;
		$_SESSION['googleReviewRatings'] = $googleReviewRatings;
		$_SESSION['picture'] = $picture;
		header("location: updateRestaurant.php");
		break;
	}
}
if ($flag == 0)
	echo "<h2 id='result'>No record found.</h2>";
?>