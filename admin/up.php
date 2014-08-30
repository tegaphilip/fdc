<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Publications.php';
require_once '../classes/Utilities.php';
require_once '../classes/Conference.php';

new Database();
new Constants();
$admin = new Administrator();
$publi = new Publication();
$util = new Utilities();
$admin->validateLogin();


echo mysql_query("UPDATE conferences SET logo = 'photo2.jpg' WHERE conference_code = 'WIMPGZK0EO34952'");

?>