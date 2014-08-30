<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Conference.php';
require_once '../classes/Sponsor.php';
require_once '../classes/Affiliation.php';
require_once '../classes/Linkage.php';
require_once '../classes/Member.php';

new Database();
new Constants();

$admin = new Administrator();
$admin->validateLogin();

//$conf = new Conference();
$sponsor = new Sponsor();
$linkage = new Linkage();
$aff = new Affiliation();
$member = new Member();

switch($_GET[ACTION])
{
    case "deletesponsor":
        $sponsor->deleteSponsor($_GET[ID]);
        break;
    case "deletelinkage":
        $linkage->deleteLinkage($_GET[ID]);
        break;
    case "deleteaffiliation":
        $aff->deleteAffiliation($_GET[ID]);
        break;
    case "togglememberstatus":
        $member->toggleMemberStatus($_GET[ID]);
        break;
    case "deletemember":
        $member->deleteMember($_GET[ID]);
        break;
    case "toggleadminstatus":
        $admin->toggleAdminStatus($_GET[ID]);
        break;
    case "deleteadmin":
        $admin->deleteAdmin($_GET[ID]);
        break;
    default:
        break;
        
}
echo "<script language='javascript'>window.location = '".$_SERVER['HTTP_REFERER']."';</script>";	
?>