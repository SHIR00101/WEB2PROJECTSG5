<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
		integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
		integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
		crossorigin="anonymous"></script>
</head>

<body>
	<?php
	session_start();
	$xml = new domdocument("1.0");
	$xml->load("BSIT3EG1G5.xml");
	$buffets = $xml->getElementsByTagName("buffet");
	$Search = "";
	$Search = $_SESSION["Search"];
	$flag = 0;
	foreach ($buffets as $buffet) {
		$name = strtolower($buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue);

		if ($Search == $name) {
			$flag = 1;
			$xml->getElementsByTagName("buffets")->item(0)->removeChild($buffet);
			$xml->save("BSIT3EG1G5.xml");
			echo "<script>alert('Record deleted!');window.location='home.php'</script>";
			break;
		}
	}
	if ($flag == 0) {
		echo "<script>alert('There is no such record!');window.location='home.php'</script>";
	}

	?>
</body>
</div>