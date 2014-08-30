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
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a> <span class="divider">/</span></li>
			<li class="active">Update Profile</li>
		</ul>
	  <p>
			<div class="span8">
				
				<form class="form-horizontal" action="#" method="post">
					<fieldset>
					<div class="span6 no_margin_left">
					<legend>Your login </legend>
					<div class="span6 no_margin_left">
					  <div class="control-group">
						<label class="control-label">Old Password</label>
						<div class="controls docs-input-sizes">
						  <input type="password" class="span4">
						</div>
					  </div>					 
					  </div>					 
<div class="span6">
					  <div class="control-group">
						<label class="control-label">New Password</label>
						<div class="controls docs-input-sizes">
						  <input type="text" class="span4">
						</div>
					  </div>					  <div class="control-group">
						<label class="control-label">Confirm password</label>
						<div class="controls docs-input-sizes">
						  <input type="text" class="span4">
						</div>
					  </div>
					</div>

					  </div>

				<div class="span6 no_margin_left">
					<hr>
                        <div class="span2"><button class="btn btn-primary btn-large pull-right" type="submit">Change Password</button></div>
          </div></fieldset>
				  </form>
	  
			</div>
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