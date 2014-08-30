<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Conference.php';

new Database();
new Constants();

$admin = new Administrator();
$admin->validateLogin();

$conf = new Conference();

switch($_GET[ACTION])
{
    case "current":
        $conf->setCurrent($_GET[ID]);
        break;
    case "delete":
        $conf->delete($_GET[ID]);
        break;
    case "deleteconfdetail":
        $conf->deleteDetailsOfConference(base64_decode($_GET[ID]));
        break;
    case "deleteparticipant":
        $conf->deleteParticipant(base64_decode($_GET[ID]));
        break;
    default:
        break;
        
}
echo "<script language='javascript'>window.location = '".$_SERVER['HTTP_REFERER']."';</script>";	
?>