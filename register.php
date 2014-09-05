<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';

$db = new Database();
new Constants();
$member = new Member();

$salutations = $db->getWhere(SALUTATIONS,null,array(SALUTATION=>"ASC"));
$countries = $db->getWhere(COUNTRIES, null, array(COUNTRY_NAME=>"ASC"));
$states = $db->getWhere(STATES, null, array(STATE_NAME=>"ASC"));
$affiliations = $db->getWhere(AFFILIATIONS,null,array(AFFILIATION_NAME=>"ASC"));

if(isset($_POST['Submit'])){
    $reg_response = $member->addNewMember();
}

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
      <!--SLIDER HERE--><!--SLIDER-->
        <div class="span8">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a> <span class="divider">/</span></li>
			<li class="active">Register</li>
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
					<div class="span6 no_margin_left">
						<legend>Your Personal Details</legend>
                      
                      <div class="control-group">
						<label class="control-label">Title</label>
						<div class="controls docs-input-sizes">
						  <select name="<?php echo TITLE; ?>" id="<?php echo TITLE; ?>">
                             <?php
                             foreach ($salutations as $sal) 
                             {
                             ?>
                                <option <?php if($_POST[TITLE]==$sal[SALUTATION]) echo "selected='selected'"; ?>
                                    value="<?php echo $sal[SALUTATION]; ?>">
                                    <?php echo $sal[SALUTATION]; ?>
                                </option>
                             <?php
                             }
                             ?>
                          </select>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label">First Name</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[FIRST_NAME]; ?>" name="<?php echo FIRST_NAME; ?>" type="text" class="span4" id="<?php echo FIRST_NAME; ?>" placeholder="Firstname">
						</div>
					  </div>
                      <div class="control-group">
						<label class="control-label">Other Names</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[OTHER_NAMES]; ?>" name="<?php echo OTHER_NAMES; ?>" type="text" class="span4" id="<?php echo OTHER_NAMES; ?>" placeholder="Other names">
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label">Last Name</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[LAST_NAME]; ?>" name="<?php echo LAST_NAME; ?>" type="text" class="span4" id="<?php echo LAST_NAME; ?>" placeholder="Lastname">
						</div>
					  </div>
                      <div class="control-group">
						<label class="control-label">Gender</label>
						<div class="controls docs-input-sizes">
						  <select name="<?php echo GENDER; ?>" id="<?php echo GENDER; ?>">
                          	<option <?php if($_POST[GENDER]=="M") echo "selected = 'selected'"; ?> value="M">Male</option>
                            <option <?php if($_POST[GENDER]=="F") echo "selected = 'selected'"; ?> value="F">Female</option>
                          </select>
						</div>
					  </div>					  
					  <div class="control-group">
						<label class="control-label">Email Address</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[EMAIL]; ?>" name="<?php echo EMAIL; ?>" type="text" class="span4" id="<?php echo EMAIL; ?>" placeholder="Email">
						</div>
					  </div>					 

					  <div class="control-group">
						<label class="control-label">Telephone</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[TELEPHONE]; ?>" name="<?php echo TELEPHONE; ?>" type="text" class="span4" id="<?php echo TELEPHONE; ?>" placeholder="Phone number">
						</div>
					  </div>
                      
                       <div class="control-group">
						<label class="control-label">Profession:</label>
						<div class="controls docs-input-sizes">
                        <input value="<?php echo $_POST[PROFESSION]; ?>" name="<?php echo PROFESSION; ?>" type="text" class="span4" id="<?php echo PROFESSION; ?>" placeholder="Profession">
                        </div>
					  </div>
                      
                      <div class="control-group">
						<label class="control-label">University:</label>
						<div class="controls docs-input-sizes">
						 <select name="<?php echo AFFILIATION_ID; ?>" id="<?php echo AFFILIATION_ID; ?>">
                             <?php
                             foreach ($affiliations as $aff) 
                             {
                             ?>
                                <option <?php if($_POST[AFFILIATION_ID]==$aff[AFFILIATION_ID]) echo "selected='selected'"; ?>
                                    value="<?php echo $aff[AFFILIATION_ID]; ?>">
                                    <?php echo $aff[AFFILIATION_NAME]; ?>
                                </option>
                             <?php
                             }
                             ?>
                          </select>
						</div>
					  </div>
                      
					  <div class="span6">
					<legend>Your Address </legend>
					  <div class="control-group">
						<label class="control-label">Address</label>
						<div class="controls docs-input-sizes">
						   <textarea name="<?php echo CONTACT_ADDRESS; ?>" rows="3" class="input-xlarge span4" id="textarea"  placeholder="your correspondence address"><?php echo $_POST[CONTACT_ADDRESS]; ?></textarea>
						</div>
					  </div>
					 
                       <div class="control-group">
						<label class="control-label">Country</label>
						<div class="controls docs-input-sizes">
						  <select name="<?php echo COUNTRY_ID; ?>" id="<?php echo COUNTRY_ID; ?>">
                             <?php
                             foreach ($countries as $country) 
                             {
                             ?>
                                <option <?php if($_POST[COUNTRY_ID]==$country[COUNTRY_ID]) echo "selected='selected'"; ?>
                                    value="<?php echo $country[COUNTRY_ID]; ?>">
                                    <?php echo $country[COUNTRY_NAME]; ?>
                                </option>
                             <?php
                             }
                             ?>
                          </select>
						</div>
					  </div>
                       <div class="control-group">
						<label class="control-label">State (Nigerians only)</label>
						<div class="controls docs-input-sizes">
						  <select name="<?php echo STATE_ID; ?>" id="<?php echo STATE_ID; ?>">
                             <?php
                             foreach ($states as $state) 
                             {
                             ?>
                                <option <?php if($_POST[STATE_ID]==$state[STATE_ID]) echo "selected='selected'"; ?>
                                    value="<?php echo $state[STATE_ID]; ?>">
                                    <?php echo $state[STATE_NAME]; ?>
                                </option>
                             <?php
                             }
                             ?>
                          </select>
						</div>
					  </div>
                     <!--<div class="control-group">
						<label class="control-label">City</label>
						<div class="controls docs-input-sizes">
						  <select name="city">
                             <option value="">--select--</option>
                          </select>
						</div>
					  </div>
					  <div class="control-group">
						<label class="control-label">ZIP</label>
						<div class="controls docs-input-sizes">
						  <input type="text" placeholder="" class="span3">
						</div>
					  </div>					  
                     
					  </div>-->
					  
					<div class="span6 no_margin_left">
					<legend>Your login </legend>
					<div class="span6 no_margin_left">
					  <div class="control-group">
						<label class="control-label">Username</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[USERNAME]; ?>" name="<?php echo USERNAME; ?>" 
                                                         type="text" class="span4" id="<?php echo USERNAME; ?>" placeholder="Username">
						</div>
					  </div>					 
					  </div>					 
                                        <div class="span6 no_margin_left">
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
						  <input name="<?php echo CONFIRM_PASSWORD; ?>" type="password" class="span4" id="<?php echo CONFIRM_PASSWORD; ?>" placeholder="">
						</div>
					  </div>
					</div>

					  </div>

				<div class="span6 no_margin_left">
					<hr>
                        <div class="span2"><button class="btn btn-primary btn-large pull-right" type="submit" name="Submit" id="Submit">Register</button></div>
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