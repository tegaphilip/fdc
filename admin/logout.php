<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';

new Database();
new Constants();
$admin = new Administrator();

$admin->logout();
?>