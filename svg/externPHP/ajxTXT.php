<?php
//$filename = $_POS["filename"];
$array = explode("\n", file_get_contents("C:/webprojekte/repo/master/svg/assets/IHNN-Fragen.txt"));
$strReturn = json_encode($array);
echo $strReturn;