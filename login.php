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
}else{
    $login_response = $_SESSION[TRANSFERER];
    unset($_SESSION[TRANSFERER]);
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
        <div class="span12">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a> <span class="divider">/</span></li>
			<li class="active">Login</li>
		</ul>
	  <p>
			<div class="span8">
				
				<form class="form-horizontal" action="#" method="post">
					<fieldset>
                                                  
					  
					<div class="span6 no_margin_left">
					<legend>Login</legend>
                    <div align="left">
						<?php
                            if(isset($login_response))
                                print_r($login_response);
                        ?>
                    </div>
                    <br>
					<div class="span6 no_margin_left">
					  <div class="control-group">
						<label class="control-label">Username</label>
						<div class="controls docs-input-sizes">
						  <input required name="<?php echo USERNAME; ?>" type="text" class="span4" id="<?php echo USERNAME; ?>" placeholder="Username">
						</div>
					  </div>					 
					  </div>					 
                                        <div class="span6 no_margin_left">
					  <div class="control-group">
						<label class="control-label">Password</label>
						<div class="controls docs-input-sizes">
						  <input required name="<?php echo PASSWORD; ?>" type="password" class="span4" id="<?php echo PASSWORD; ?>"
                                                         placeholder="">
						</div>
					  </div>					  
                                         
					</div>

					  </div>

				<div class="span6 no_margin_left">
                        <div class="span2"><button class="btn btn-primary btn-large pull-right" type="submit" name="btnLogin" id="btnLogin">Login</button></div>&nbsp;&nbsp;&nbsp;<span class="span2"><a href="password_request.php">Forgot Password</a></span>
          </div></fieldset>
				  </form>
	  
			</div>
            </p>
            </div>
         
      </div>
    <?php require_once('footer.php');?>
</div>
</body>
</html>