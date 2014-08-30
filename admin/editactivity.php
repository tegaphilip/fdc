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
    $response = $conference->editActivity();
}
$conf = $conference->getActivity(base64_decode($_GET[ID]));

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
	      <h5>Edit Activity</h5></div>
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
                        <label class="control-label" for="">Date *</label>
                        <div class="controls controls-row">
                          <select name="<?php echo START_MONTH; ?>" id="<?php echo START_MONTH; ?>" class="span2">
                              <?php
                                $smonth = date("m",$conf[START_TIME]);
                                $sday = date("d",$conf[START_TIME]);
                                $syear = date("Y",$conf[START_TIME]);
                                $shour = date("g",$conf[START_TIME]);
                                $sminute = date("i",$conf[START_TIME]);
                                $smeridian = date("a",$conf[START_TIME]);
                               
                                $ehour = date("g",$conf[END_TIME]);
                                $eminute = date("i",$conf[END_TIME]);
                                $emeridian = strtoupper(date("a",$conf[END_TIME]));
                                ?>
                              <option value="">
                              - Month -
                              </option>
                              <?php
                                foreach($util->getMonths() as $key => $val){
                              ?>
                              <option <?php if($smonth==$key) echo "selected='selected'"; ?> 
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
                              <option <?php if($sday==$i) echo "selected='selected'"; ?> 
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
                              <option <?php if($syear==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php }?>
                          </select>
                          
                        </div>
                      </div>
                        
                      <div class="control-group">
                        <label class="control-label">
                          Program *
                        </label>
                        <div class="controls controls-row">
                            <input class="span6" type="text" placeholder="E.g Pre-Conference workshop" 
                                   name="<?php echo DAY_TITLE; ?>" id="<?php echo DAY_TITLE; ?>"
                                   value="<?php echo $conf[DAY_TITLE]; ?>">
                        </div>
                      </div>
                        
                        <div class="control-group">
                        <label class="control-label">
                          Start Time
                        </label>
                        <div class="controls">
                            
                            <select name="sh" id="sh"  class="span2 input-left-top-margins">
<!--                                <option value="">-Hour-</option>-->
                            <?php
                                for($i=1;$i<=12;$i++){
                              ?>
                              <option <?php if($shour==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo strlen($i)==1?"0".$i:$i; ?></option>
                              <?php }?>
                          </select>
                            <select name="sm" id="sm"  class="span2 input-left-top-margins">
<!--                                <option value="">-Minute-</option>-->
                            <?php
                                for($i=0;$i<=60;$i+=5){
                              ?>
                              <option <?php if($sminute==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo strlen($i)==1?"0".$i:$i; ?></option>
                              <?php }?>
                          </select>
                            <select name="sme" id="sme"  class="span2 input-left-top-margins">   
<!--                                <option value="">----</option>-->
                            <?php
                                $arr = array("AM","PM");
                                foreach($arr as $a){
                              ?>
                              <option <?php if($smeridian==$a) echo "selected='selected'"; ?> 
                                  value="<?php echo $a; ?>"><?php echo $a; ?></option>
                              <?php }?>
                          </select>
                        </div>
                      </div>
                        
                        <div class="control-group">
                        <label class="control-label">
                          End Time
                        </label>
                        <div class="controls">
                            
                          <select name="eh" id="eh"  class="span2 input-left-top-margins">
<!--                              <option value="">-Hour-</option>-->
                            <?php
                                for($i=1;$i<=12;$i++){
                              ?>
                              <option <?php if($ehour==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo strlen($i)==1?"0".$i:$i; ?></option>
                              <?php }?>
                          </select>
                            <select name="em" id="em"  class="span2 input-left-top-margins">
<!--                                <option value="">-Minute-</option>-->
                            <?php
                                for($i=0;$i<=60;$i+=5){
                              ?>
                              <option <?php if($eminute==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo strlen($i)==1?"0".$i:$i; ?></option>
                              <?php }?>
                          </select>
                            <select name="eme" id="eme"  class="span2 input-left-top-margins">    
<!--                                <option value="">----</option>-->
                            <?php
                                $arr = array("AM","PM");
                                foreach($arr as $a){
                              ?>
                              <option <?php if($emeridian==$a) echo "selected='selected'"; ?> 
                                  value="<?php echo $a; ?>"><?php echo $a; ?></option>
                              <?php }?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-actions no-margin">
                          <input type="hidden" name="<?php echo CONFERENCE_DETAIL_ID; ?>" value="<?php echo $conf[CONFERENCE_DETAIL_ID]; ?>"/>
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
