<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Publications.php';

new Database();
new Constants();

$admin = new Administrator();
$admin->validateLogin();

$publ = new Publication();

switch($_GET[PUBLIACTION])
{
    case "deleteJ":
        $publ->deleteJournal($_GET[JOURNALS_ID]);
        break;
    
    case "deleteB":
        $publ->deleteBook($_GET[BOOKS_ID]);
        break;
    
    default:
        break;
        
}
echo "<script language='javascript'>window.location = '".$_SERVER['HTTP_REFERER']."';</script>";	
?>