<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';

$db = new Database();
new Constants();
$member = new Member();

if(isset($_POST['btnLogin'])){
    $login_response = $member->login();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>::FDC::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link id="switch_style" href="bootstrap/css/united/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/jquery.rating.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
	<?php require_once('header.php');?>
      <div class="row">
      <!--SLIDER HERE-->
      <div class="span12">
       	<?php require_once('imagerotator.html');?>
       </div>
		  <!--SLIDER-->
            <div class="span8">
             	<h4 class="breadcrumb">Welcome</h4>
                <p>
                    Welcome to the homepage of the Faculty Development Centre.
                    FDC is dedicated to promoting academics as stated in their Vision Statement.
                </p>

                <p>
                    FDC History is centrally on human capacity building, skills enrichment, manpower development research work, feasebility studies, training  community development and services dating back to 2010. FDC enhances human resource development, resourcefulness innovativeness and creativity through learning and continuing education of lifelong impact.
                </p>

                <p>
                    It is headed by the Managing Consultant, Jonathan E. Oghenekohwo, Ph.D. (<a target="_blank" href="docs/CV%20of%20Jonathan%20Oghenekohwo.doc">Download CV</a>)
                </p>

               <p style="text-align: center;">
                    <img src="images/Capacity-Building-1000-by-460-670x300.jpg" alt="Socrates" title="Socrates">
               </p>
                <?php require_once('aims.php'); ?>
            </div>
            <div class="span4 pull-right">
            	<?php require_once 'login_newaccount.php';?>
            </div>
         
      </div>
      <!--sponsorship partnership
        <div class="row-fluid mardiv span12">
        	<marquee>sponsors link</marquee>
        </div>-->
    <?php require_once('footer.php');?>
</div>
</body>
</html>