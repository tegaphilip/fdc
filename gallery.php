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
		  <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
            
              <div class="item">
                  <a href="conference.php?id=WIMPGZK0EO34952"><img src="images/photo_home_page_small.jpg" alt=""></a>
                <div class="carousel-caption">
                  <h4>Up Coming Conference</h4>
                  <p>Philosophy of Education for Social Ethics.</p>
                </div>
              </div>
              
              <div class="item active">
                <img src="css/images/carousel_2.jpg" alt="">
                <div class="carousel-caption">
                  <h4>...</h4>
                  <p>...</p>
                </div>
              </div>
                
                <div class="item">
                <img src="css/images/carousel_1.jpg" alt="">
                <div class="carousel-caption">
                  <h4>...</h4>
                  <p>...</p>
                </div>
              </div>
                
                <div class="item">
                <img src="css/images/carousel_3.jpg" alt="">
                <div class="carousel-caption">
                  <h4>...</h4>
                  <p>...</p>
                </div>
              </div>
              
            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
          </div>
          </div>
            
            <div class="span4 pull-right">
            	<?php //require_once 'login_newaccount.php';?>
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