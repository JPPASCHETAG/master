<?php
$filename = $_POST["filename"];
$array = explode("\n", file_get_contents("../assets/".$filename));
$strReturn = json_encode($array);
echo $strReturn;