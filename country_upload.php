<?php

require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';


$db = new Database();
$util = new Utilities();
new Constants();

$filename = 'countries.txt';

$fh = fopen($filename,'r') or die('Couldnt find file');
//$content = fread($fh, filesize($filename));

//echo $content;
$i =0;
while(!feof($fh)){
    $line = explode("'",trim(fgetss($fh)));
    $line = explode(" ",$line[1]);
    $line = $line[0];
    //echo $line[0]."<br>";
    $code = $util->getUniqueCode(STATES, STATE_CODE);
    $data = array(
        STATE_CODE => $code,
        STATE_NAME => $line
    );
    $db->insertIntoTable(STATES, $data);
    $i++;
}
fclose($fh);

echo $i;
?>