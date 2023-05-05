<?php
session_start();
$xml = new domdocument("1.0");
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load("BSIT3EG1G5.xml");

$searchRName = $_SESSION['restaurantName'];
$basePrice = $_POST["basePrice"];
$serviceOptions = implode(", ", $_POST["serviceSelection"]);
$location = $_POST["location"];
$openingHours = $_POST["openingHours"];
$googleReviewRating = $_POST["googleReviewRating"];
$picture = $_POST["picture"];
$flag = 0;

$buffets = $xml->getElementsByTagName("buffet");
foreach ($buffets as $buffet) {
	$id = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
	if ($searchRName == $id) {
	
		$flag = 1;
		$restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;

		$newNode = $xml->createElement("buffet");

		$pic = $xml->createElement("picture");
		$image = "pictures/".$picture;
		$imageData = file_get_contents($image);
		$base64 = base64_encode($imageData);
		$cdata = $xml ->createCDATASection($base64);

		$rName = $xml->createElement("restaurantName", $restaurantName);
		$bPrice = $xml->createElement("basePrice", $basePrice);
		$sOptions = $xml->createElement("serviceOptions", $serviceOptions);
		$Location = $xml->createElement("location", $location);
		$oHours = $xml->createElement("openingHours", $openingHours);
		$gReviewRating = $xml->createElement("googleReviewRatings", $googleReviewRating);
		$pic->appendChild($cdata);

		$newNode->appendChild($rName);
		$newNode->appendChild($bPrice);
		$newNode->appendChild($sOptions);
		$newNode->appendChild($Location);
		$newNode->appendChild($oHours);
		$newNode->appendChild($gReviewRating);
		$newNode ->appendChild($pic);

		$oldNode = $buffet;

		$xml->getElementsByTagName("buffets")->item(0)->replaceChild($newNode, $oldNode);
		$xml->save("BSIT3EG1G5.xml");

		echo "<script>alert('Record updated!');window.location='update.php'</script>";
	}
}
if ($flag == 0)
	echo "<script>alert('Record not updated!');window.location='update.php'</script>";
?>
