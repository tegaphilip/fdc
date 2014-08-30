<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Conference.php';
require_once '../classes/Utilities.php';


$db = new Database();
new Constants();
$admin = new Administrator();
$conference = new Conference();
$util = new Utilities();
$admin->validateLogin();

$reg_types = $db->getWhere(CONFERENCE_REGISTRATION_TYPES,null,array(CONFERENCE_REGISTRATION_TYPE_NAME=>"ASC"));
$affiliations = $db->getWhere(AFFILIATIONS,null,array(AFFILIATION_NAME=>"ASC"));
$conferences = $db->getWhere(CONFERENCES,null,array(START_DATE=>"ASC"));

if(isset($_POST['Save'])){
    $response = $conference->addParticipant();
}

?>

<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from wbpreview.com/previews/WB0F35928/ by HTTrack Website Copier/3.x [XR&CO'2002], Fri, 22 Feb 2013 05:36:32 GMT -->
<head>
		<title>::ADMIN PANEL::</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="css/fullcalendar.css" />	
		<link rel="stylesheet" href="css/unicorn.main.css" />
		<link rel="stylesheet" href="css/unicorn.grey.css" class="skin-color" />
	</head>
	<body>
		<?php require_once 'included_file.php';?>
		<div id="content">
	  <div id="content-header">
				<h1>MANAGING PARTICIPANTS</h1>
			</div>
			<div id="breadcrumb">
                            <a href="adhome.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Conference</a>
			</div>
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <h5>Add New Participant</h5></div>
        <div class="widget-content">
								
                                <!--form-->
              <div class="row-fluid">
              <div class="span8">
                <div class="widget">
                  <div class="widget-header">
                    <span class="tools">
                      <a class="fs1" aria-hidden="true" data-icon="&#xe090;"></a>
                    </span>
                  </div>
                  <div class="widget-body">
                    <form class="form-horizontal no-margin" method="post" action="">
                        <div class="control-group">
                        <div class="controls controls-row">
                          <?php if(isset($response)) print_r($response); ?>
                        </div>
                      </div>
                      

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
<label class="control-label">Is this person a member of FDC?</label>
						<div class="controls docs-input-sizes">
                                                    <table width='50%'>
                                                        <tr>
                                                            <td><input type="radio" name="<?php echo IS_MEMBER; ?>" id="<?php echo IS_MEMBER; ?>" value="1" <?php if($_POST[IS_MEMBER]=="1") echo 'checked="checked"'; ?>>
                      <label for="radio">Yes</label></td>
                                                            <td><input type="radio" name="<?php echo IS_MEMBER; ?>" id="<?php echo IS_MEMBER; ?>" value="0" 
                          <?php if($_POST[IS_MEMBER]=="0") echo 'checked="checked"'; ?>>
                                            <label for="radio2">No</label></td>
                                                        </tr>
                                                    </table>
								 
                        	
						</div>
					  </div>
                                            
                       <div class="control-group">
						<label class="control-label">Conference:</label>
						<div class="controls docs-input-sizes">
						 <select name="<?php echo CONFERENCE_ID; ?>" id="<?php echo CONFERENCE_ID; ?>">
                             <?php
                             foreach ($conferences as $reg) 
                             {
                             ?>
                                <option <?php if($_POST[CONFERENCE_ID]==$reg[CONFERENCE_ID]) echo "selected='selected'"; ?>
                                    value="<?php echo $reg[CONFERENCE_ID]; ?>">
                                    <?php echo $reg[CONFERENCE_TITLE]; ?>
                                </option>
                             <?php
                             }
                             ?>
                          </select>
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
                       
                         <div class="control-group">
                            <label class="control-label">Amount paid</label>
                            <div class="controls docs-input-sizes">
                                <input value="<?php echo $_POST[AMOUNT_PAID]; ?>" name="<?php echo AMOUNT_PAID; ?>" type="text" class="span4" id="<?php echo AMOUNT_PAID; ?>" placeholder="Amount this person paid">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">Confirm Payment</label>
                            <div class="controls docs-input-sizes">
                                <input type="checkbox" value="1" name="<?php echo PAYMENT_CONFIRMED; ?>" 
                                       id="<?php echo PAYMENT_CONFIRMED; ?>" 
                                           <?php if($_POST[PAYMENT_CONFIRMED]=="1") echo "checked='checked'"; ?>/>
                            </div>
                        </div>
                      
                        
                        <div class="control-group">
                            <label class="control-label">Date Payment was made</label>
                            <div class="controls docs-input-sizes">
                                <input value="<?php echo $_POST[DATE_PAYMENT_WAS_MADE]; ?>" name="<?php echo DATE_PAYMENT_WAS_MADE; ?>" type="text" class="span4" id="<?php echo DATE_PAYMENT_WAS_MADE; ?>" 
                                       placeholder="dd-mm-yyyy">
                            </div>
                        </div>
                        
                     
                      
                      <div class="form-actions no-margin">
                        <button name="Save" type="submit" class="btn btn-info pull-left">
                          Add Participant
                        </button>
                        <div class="clearfix">
                        </div>
                      </div>
                      
                    </form>
                    
                  </div>
                </div>
              </div>
          </div>
                                <!--widget form end-->
							</div>
						</div>					
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6"></div>
					<div class="span6"></div>
				</div>
				<div class="row-fluid">
					<div class="span12"></div>
				</div>
				<?php require_once 'footer.php'; ?>
			</div>
		</div>
		
	</body>
</html>
