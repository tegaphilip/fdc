<?php
require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';

$db = new Database();
new Constants();
$member = new Member();

if(isset($_POST['Submit'])){
    $reg_response = $member->retrievePassword();
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
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a> <span class="divider">/</span></li>
			<li class="active">Retrieve Password</li>
		</ul>
	  <p>
			<div class="span8">
				
				<form class="form-horizontal" action="#" method="post">
					<fieldset>
                                            <div align="left">
                                                <?php
                                                    if(isset($reg_response))
                                                        print_r($reg_response);
                                                ?>
                                            </div>
						<legend>Retrieve Password</legend> 
                        
                        <div class="control-group">
						<label class="control-label">Email Address</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[EMAIL]; ?>" name="<?php echo EMAIL; ?>" type="text" class="span4" id="<?php echo EMAIL; ?>" placeholder="Email">
						</div>
					  </div>
                      
                      <div class="control-group">
						<label class="control-label"></label>
						<div class="controls docs-input-sizes">
						  <button class="btn btn-primary btn-large" type="submit" name="Submit" id="Submit">Retrieve Password</button>
						</div>
					  </div>
                     </fieldset>
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