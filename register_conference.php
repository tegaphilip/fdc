<?php
require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';
require_once 'classes/Conference.php';

$db = new Database();
new Constants();
$conf = new Conference();   
$util = new Utilities();
$conference = $conf->getConference($_GET[ID]);
if(count($conference)==0){
    $_SESSION[ERROR_TRANSFERER] = "The page you are attempting to visit was not found!<br>
        Click <a href='index.php'>here</a> to go to our home page";
    header("location:error.php");
}

$reg_types = $db->getWhere(CONFERENCE_REGISTRATION_TYPES,null,array(CONFERENCE_REGISTRATION_TYPE_NAME=>"ASC"));
$affiliations = $db->getWhere(AFFILIATIONS,null,array(AFFILIATION_NAME=>"ASC"));


if(isset($_POST['Submit'])){
    $reg_response = $conf->registerForConference();
}

$info = 
"<table width='100%' cellspacing='2' cellpadding='2' class='table'>
    <tr>
        <th colspan='2'>Conference Fees (Note that this covers vetting, dinner and tours)</th>
    </tr>
    <tr>
        <td>Online Registration</td><td>NGN 15,000.00</td>
    </tr>
    <tr>
        <td>Onsight/Venue Registration</td><td>NGN 20,000.00</td>
    </tr>
    <tr>
        <td>Institutional Registration</td><td>NGN 30,000.00</td>
    </tr>
    <tr>
        <td>Student Registration</td><td>NGN 7,000.00</td>
    </tr>
    <tr>
        <td colspan='2'>Payment should be made to:
            <br>Bank : First Bank
            <br>Account Name : ********
            <br>Account nNumber : *************
        </td>
    </tr>
</table>";
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
			<li class="active">Register for <?php echo $conference[CONFERENCE_TITLE]; ?></li>
		</ul>
	  <p>
			<div class="span8">
				
				<form class="form-horizontal" action="#" method="post">
					<fieldset>
                                            <div>
                                                <?php
                                                echo $util->displayInfoMessage($info);
                                                ?>
                                            </div>
                                            <div align="left">
                                                <?php
                                                    if(isset($reg_response))
                                                        print_r($reg_response);
                                                ?>
                                            </div>
					<div class="span6 no_margin_left">
						
					  <div class="control-group">
						<label class="control-label">Full Name</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[FULL_NAME]; ?>" name="<?php echo FULL_NAME; ?>" type="text" class="span4" id="<?php echo FULL_NAME; ?>" placeholder="E.g. Dr. Lawal Kwali">
						</div>
					  </div>
                                            
					  <div class="control-group">
						<label class="control-label">Email Address</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[EMAIL]; ?>" name="<?php echo EMAIL; ?>" type="text" class="span4" id="<?php echo EMAIL; ?>" placeholder="Email">
						</div>
					  </div>
                                         
<div class="control-group">
<label class="control-label">Are you a member of FDC?</label>
						<div class="controls docs-input-sizes">
								 <input type="radio" name="<?php echo IS_MEMBER; ?>" id="<?php echo IS_MEMBER; ?>" value="1" <?php if($_POST[IS_MEMBER]=="1") echo 'checked="checked"'; ?>>
                      <label for="radio">Yes</label>
                      <input type="radio" name="<?php echo IS_MEMBER; ?>" id="<?php echo IS_MEMBER; ?>" value="0" 
                          <?php if($_POST[IS_MEMBER]=="0") echo 'checked="checked"'; ?>>
                                            <label for="radio2">No</label>  	
						</div>
					  </div>
                                            
                                            <div class="control-group">
						<label class="control-label">Registration Type:</label>
						<div class="controls docs-input-sizes">
						 <select name="<?php echo CONFERENCE_REGISTRATION_TYPE_ID; ?>" id="<?php echo CONFERENCE_REGISTRATION_TYPE_ID; ?>">
                             <?php
                             foreach ($reg_types as $reg) 
                             {
                             ?>
                                <option <?php if($_POST[CONFERENCE_REGISTRATION_TYPE_ID]==$reg[CONFERENCE_REGISTRATION_TYPE_ID]) echo "selected='selected'"; ?>
                                    value="<?php echo $reg[CONFERENCE_REGISTRATION_TYPE_ID]; ?>">
                                    <?php echo $reg[CONFERENCE_REGISTRATION_TYPE_NAME]; ?>
                                </option>
                             <?php
                             }
                             ?>
                          </select>
						</div>
					  </div>

					  <div class="control-group">
						<label class="control-label">Telephone</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[TELEPHONE]; ?>" name="<?php echo TELEPHONE; ?>" type="text" class="span4" id="<?php echo TELEPHONE; ?>" placeholder="Phone number">
						</div>
					  </div>
                                            
                      <div class="control-group">
						<label class="control-label">Affiliation:</label>
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
				<div class="span6 no_margin_left">
                                    <input type="hidden" name="<?php echo CONFERENCE_ID; ?>" 
                                           value="<?php echo $conference[CONFERENCE_ID]; ?>" />
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