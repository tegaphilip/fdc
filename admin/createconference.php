<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Conference.php';
require_once '../classes/Utilities.php';


new Database();
new Constants();
$admin = new Administrator();
$conference = new Conference();
$util = new Utilities();
$admin->validateLogin();



if(isset($_POST['Save'])){
    $response = $conference->createConference();
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
				<h1>MANAGING CONFERENCES</h1>
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
	      <h5>Create Conference</h5></div>
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
                          <?php if(isset($response)) echo $response; ?>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">
                          Conference Title
                        </label>
                        <div class="controls controls-row">
                            <input class="span6" type="text" placeholder="Conference title" 
                                   name="<?php echo CONFERENCE_TITLE; ?>" id="<?php echo CONFERENCE_TITLE; ?>"
                                   value="<?php echo $_POST[CONFERENCE_TITLE]; ?>">
                        </div>
                      </div>

                    <div class="control-group">
                        <label class="control-label">
                          Amount Charged
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="Amount"
                                 name="<?php echo AMOUNT_CHARGED; ?>" id="<?php echo AMOUNT_CHARGED; ?>"
                                 value="<?php echo $_POST[AMOUNT_CHARGED]; ?>">
                        </div>
                      </div>

                       <div class="control-group">
                        <label class="control-label" for="DateOfBirthMonth">Start Date </label>
                        <div class="controls controls-row">
                          <select name="<?php echo START_MONTH; ?>" id="<?php echo START_MONTH; ?>" class="span2">
                              <option value="">
                              - Month -
                              </option>
                              <?php
                                foreach($util->getMonths() as $key => $val){
                              ?>
                              <option <?php if($_POST[START_MONTH]==$key) echo "selected='selected'"; ?> 
                                  value="<?php echo $key; ?>"><?php echo $val; ?></option>
                              <?php }?>
                          </select>
                          <select name="<?php echo START_DAY; ?>" id="<?php echo START_DAY; ?>"  class="span2 input-left-top-margins">
                              <option value="">
                              - Day -
                            </option>
                            <?php
                                for($i=1;$i<=31;$i++){
                              ?>
                              <option <?php if($_POST[START_DAY]==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php }?>
                          </select>
                          
                          <select name="<?php echo START_YEAR; ?>" id="<?php echo START_YEAR; ?>" class="span2 input-left-top-margins">
                              <option value="">
                              - Year -
                            </option>
                            <?php
                                for($i=date("Y")-4;$i<=date("Y")+4;$i++){
                              ?>
                              <option <?php if($_POST[START_YEAR]==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php }?>
                          </select>
                          
                        </div>
                      </div>
                      

                      <div class="control-group">
                        <label class="control-label" for="DateOfBirthMonth">
                          End Date
                        </label>
                        <div class="controls controls-row">
                          <select name="<?php echo END_MONTH; ?>" id="<?php echo END_MONTH; ?>" class="span2">
                              <option value="">
                              - Month -
                            </option>
                            <?php
                                foreach($util->getMonths() as $key => $val){
                              ?>
                              <option <?php if($_POST[END_MONTH]==$key) echo "selected='selected'"; ?> 
                                  value="<?php echo $key; ?>"><?php echo $val; ?></option>
                              <?php }?>
                          </select>
                          <select name="<?php echo END_DAY; ?>" id="<?php echo END_DAY; ?>" class="span2 input-left-top-margins">
                              <option value="">
                              - Day -
                            </option>
                            <?php
                                for($i=1;$i<=31;$i++){
                              ?>
                              <option <?php if($_POST[END_DAY]==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php }?>
                          </select>
                          
                          <select name="<?php echo END_YEAR; ?>" id="<?php echo END_YEAR; ?>" class="span2 input-left-top-margins">
                              <option value="">
                              - Year -
                            </option>
                            <?php
                                for($i=date("Y")-4;$i<=date("Y")+4;$i++){
                              ?>
                              <option <?php if($_POST[END_YEAR]==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php }?>
                          </select>
                          
                        </div>
                      </div>
                        
                        <div class="control-group">
                        <label class="control-label">
                          Time
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="Time"
                                 name="<?php echo TIME; ?>" id="<?php echo TIME; ?>"
                                 value="<?php echo $_POST[TIME]; ?>">
                        </div>
                      </div>
                      
                      
                      <div class="control-group">
                        <label class="control-label">Venue
                        </label>
                        <div class="controls controls-row">
                          <textarea name="<?php echo VENUE; ?>" id="<?php echo VENUE; ?>" class="span6 input-left-top-margins" type="text" 
                                    placeholder="Conference venue"><?php echo $_POST[VENUE]; ?></textarea>
                        </div>
                      </div>
                      
                     <div class="control-group">
                        <label class="control-label">
                          Chairman
                        </label>
                        <div class="controls">
                          <input name="<?php echo CONFERENCE_CHAIRMAN; ?>" id="<?php echo CONFERENCE_CHAIRMAN; ?>" 
                                 class="span4" type="text" placeholder="Chairman"
                                 value="<?php echo $_POST[CONFERENCE_CHAIRMAN]; ?>">
                        </div>
                      </div>
                        
                        <div class="control-group">
                        <label class="control-label">
                          Chairman's Position
                        </label>
                        <div class="controls">
                          <input name="<?php echo CHAIRMAN_POSITION; ?>" id="<?php echo CHAIRMAN_POSITION; ?>"
                              class="span4" type="text" placeholder="E.g. Vice-Chancellor, UI"
                              value="<?php echo $_POST[CHAIRMAN_POSITION]; ?>">
                        </div>
                      </div>
                      
                      <div class="form-actions no-margin">
                        <button name="Save" type="submit" class="btn btn-info pull-left">
                          Save
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
