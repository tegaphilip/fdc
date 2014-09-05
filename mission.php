<?php
    require_once 'classes/Constants.php';
    new Constants();
    session_start();
    //echo $_SESSION[MEMBER_ID]."sdsd";
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
      <!--SLIDER HERE--><!--SLIDER-->
      
            <div class="span8">
             	<h4 class="breadcrumb">MISSION STATEMENT</h4>
                <p>
                    Creating in Humans Skills Beyond the Reach for Empowerment.
                </p>
               
                <br/>
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