 <?php
    $xml = new DOMDocument();
    $xml->load("BSIT3EG1G5.xml");
    $buffets = $xml->getElementsByTagName("buffet");
    $flag = 0;
    $input = strtolower($_REQUEST["q"]);
    $hint = "";
    foreach ($buffets as $buffet) {
        $rName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
        if (trim($input) != "") {
                if ($input == strtolower(substr($rName, 0, strlen($input)))) {
                    //if ($hint == "") {
                        echo "<datalist id='options'>";
                        echo "<option value='$rName'>";
                        echo "</datalist>";
                        $flag = 1;
                   // } 

                }
            }
            
    }
    if($flag===0) //if no matching name 
    {
    echo "<datalist id='options'>";
    echo "<option value='no suggesstion'>";
    echo "</datalist>";
    }
   
    ?>