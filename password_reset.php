<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';

$db = new Database();
new Constants();
$member = new Member();


if(!isset($_GET['em']) || !isset($_GET['code'])){
	$reg_response = "<div class='alert-error'>Invalid link supplied</div>";
	$load_form = false;
}else{
	$user = $db->getWhere(MEMBERS,array(EMAIL=>$_GET['em'],PASSWORD_RETRIEVAL_CODE=>$_GET['code']));
	if(count($user)==0){
		$reg_response = "<div class='alert-error'>Sorry, it is either this user doesn't exist or the link is invalid</div>";
		$load_form = false;
	}elseif($user[0][PASSWORD_RETRIEVAL_CODE_USED]==1){
		$reg_response = "<div class='alert-error'>Sorry, this password retrieval link has already been used. Please resend a new request.</div>";
		$load_form = false;
	}else{
		$load_form = true;
		$user = $user[0];
	}
}

if(isset($_POST['Submit'])){
    $reg_response = $member->resetPassword();
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
						<legend>Reset Password</legend> 
                        <?php if($load_form) {?>
                        <div class="control-group">
						<label class="control-label">Password</label>
						<div class="controls docs-input-sizes">
						  <input name="<?php echo PASSWORD; ?>" type="password" class="span4" id="<?php echo PASSWORD; ?>" 
                                                         placeholder="">
						</div>
					  </div>					  
                                            <div class="control-group">
						<label class="control-label">Confirm password</label>
						<div class="controls docs-input-sizes">
						  <input name="<?php echo CONFIRM_PASSWORD; ?>" type="password" class="span4" id="<?php echo CONFIRM_PASSWORD; ?>" placeholder=""><input type="hidden" name="member_id" value="<?php echo $user[MEMBER_ID]; ?>">
						</div>
					  </div>
                      
                      <div class="control-group">
						<label class="control-label"></label>
						<div class="controls docs-input-sizes">
						  <button class="btn btn-primary btn-large" type="submit" name="Submit" id="Submit">Reset Password</button>
						</div>
					  </div>
                      <?php }?>
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