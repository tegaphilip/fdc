<?php
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
                    Welcome to the FDC homepage. FDC is dedicated to promoting good practice of education based on sound theoretical foundation in philosophy and philosophical enterprise. FDC promotes philosophy of education among it's members, students and other practitioners in education with a view to enhancing quality practice in education in Nigeria in particular and to contribute to relevant global debate in the discipline.
                </p>
                <br/><br/><br/><br/><br/>
                <ul class="thumbnails pull-right">
                    <img src="images/socrates.JPG" alt="Socrates" title="Socrates">
               </ul>
                <ul class="thumbnails pull-right">
                    <img src="images/plato.jpg" alt="Plato" title="Plato">
               </ul>
               <ul class="thumbnails pull-right">
                   <img src="images/aristotle.jpg" alt="Plato" title="Aristotle">
               </ul>
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