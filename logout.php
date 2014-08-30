<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Member.php';

$db = new Database();
$member = new Member();

$member->logout();
?>