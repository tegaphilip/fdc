<?php
require_once 'classes/Database.php';
require_once 'classes/Member.php';
require_once 'classes/Constants.php';

$db = new Database();
$member = new Member();
new Constants();

if(isset($_GET['em']) && isset($_GET['code']))
{
    $message = $member->validateAccount($_GET['code'], $_GET['em']);
}
else    
{
    $message = "<span class='alert-error'>You have supplied an invalid link</span>";
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
		<h4 class="breadcrumb">CONTACT PEAN</h4>
	  <p>
      	<?php echo $message; ?>
	  </p>
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