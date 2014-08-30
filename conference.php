<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Constants.php';
require_once 'classes/Conference.php';
require_once 'classes/Utilities.php';
new Database();
new Constants();
$conf = new Conference();   
$util = new Utilities();
$conference = $conf->getConference($_GET[ID]);
if(count($conference)==0){
    $_SESSION[ERROR_TRANSFERER] = "The page you are attempting to visit was not found!<br>
        Click <a href='index.php'>here</a> to go to our home page";
    header("location:error.php");
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
      <!--SLIDER HERE--><!--SLIDER-->
      
            <div class="span8">
             	<h3 class="breadcrumb"><center><?php echo strtoupper($conference[CONFERENCE_TITLE]); ?></center></h3>
                <table border="0" width="100%" cellspacing='5' cellpadding='5'>
                    <tr>
                        <td colspan="2">
                            <ul class="thumbnails pull-right">
                    <?php 
                        $src = !empty($conference[LOGO])? $conference[LOGO] :"def_logo.jpg";
                    ?>
                    <img src="images/uploads/confs/<?php echo $src; ?>">
               </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><h3>THEME:</h3></td><td><?php echo $conference[CONFERENCE_TITLE]; ?></td>
                    </tr>
                    <tr>
                        <td><h3>DATE:</h3></td><td><?php echo $util->getFriendlyDate($conference[START_DATE]); ?></td>
                    </tr>
                    <tr>
                        <td><h3>TIME:</h3></td><td> <?php echo $conference[TIME]; ?></td>
                    </tr>
                    <tr>
                        <td><h3>CHAIRMAN:</h3></td><td><?php echo $conference[CONFERENCE_CHAIRMAN]." (".$conference[CHAIRMAN_POSITION].")"; ?></td>
                    </tr>
                    <tr>
                        <td><h3>VENUE:</h3></td><td><?php echo $conference[VENUE]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="register_conference.php?id=<?php echo $conference[CONFERENCE_CODE]; ?>"><button class="btn btn-primary btn-large"><strong>Register for Conference</strong></button></a>
                            <a href="conference_details.php?id=<?php echo $conference[CONFERENCE_CODE]; ?>"><button class="btn btn-primary btn-large"><strong>View More Information</strong></button></a>
                            <a href="conference_details.php?id=<?php echo $conference[CONFERENCE_CODE]; ?>"><button class="btn btn-primary btn-large"><strong>About Conference</strong></button></a>
                        </td>
                        
                    </tr>
                </table>

                
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