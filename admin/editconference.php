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
    $response = $conf->updateConference();
}

if(isset($_POST['Upload'])){
    $response2 = $conf->updateConferencePhoto();
}

$conf = $util->getDetails(CONFERENCES, CONFERENCE_CODE, $_GET['id']);
$activities = $conference->getActivities($conf[CONFERENCE_ID]);
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
                            <a href="manageconferences.php" >Conferences</a>
                            <a class="current">Edit Conference</a>
			</div>
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <h5>Edit Conference</h5></div>
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
                          <?php //print_r($conf); ?>
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
                                   value="<?php echo $conf[CONFERENCE_TITLE]; ?>">
                        </div>
                      </div>

                    <div class="control-group">
                        <label class="control-label">
                          Amount Charged
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="Amount"
                                 name="<?php echo AMOUNT_CHARGED; ?>" id="<?php echo AMOUNT_CHARGED; ?>"
                                 value="<?php echo $conf[AMOUNT_CHARGED]; ?>">
                        </div>
                      </div>

                       <div class="control-group">
                        <label class="control-label" >Start Date </label>
                        <div class="controls controls-row">
                            <?php
                                $sm = date("m",$conf[START_DATE]);
                                $sd = date("d",$conf[START_DATE]);
                                $sy = date("Y",$conf[START_DATE]);
                                $em = date("m",$conf[END_DATE]);
                                $ed = date("d",$conf[END_DATE]);
                                $ey = date("Y",$conf[END_DATE]);
                            ?>
                          <select name="<?php echo START_MONTH; ?>" id="<?php echo START_MONTH; ?>" class="span2">
                              <option value="">
                              - Month -
                              </option>
                              <?php
                                foreach($util->getMonths() as $key => $val){
                              ?>
                              <option <?php if($sm==$key) echo "selected='selected'"; ?> 
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
                              <option <?php if($sd==$i) echo "selected='selected'"; ?> 
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
                              <option <?php if($sy==$i) echo "selected='selected'"; ?> 
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
                              <option <?php if($em==$key) echo "selected='selected'"; ?> 
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
                              <option <?php if($ed==$i) echo "selected='selected'"; ?> 
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
                              <option <?php if($ey==$i) echo "selected='selected'"; ?> 
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
                                 value="<?php echo $conf[TIME]; ?>">
                        </div>
                      </div>   
                        
                      <div class="control-group">
                        <label class="control-label">Venue
                        </label>
                        <div class="controls controls-row">
                          <textarea name="<?php echo VENUE; ?>" id="<?php echo VENUE; ?>" class="span6 input-left-top-margins" type="text" 
                                    placeholder="Conference venue"><?php echo $conf[VENUE]; ?></textarea>
                        </div>
                      </div>
                      
                     <div class="control-group">
                        <label class="control-label">
                          Chairman
                        </label>
                        <div class="controls">
                          <input name="<?php echo CONFERENCE_CHAIRMAN; ?>" id="<?php echo CONFERENCE_CHAIRMAN; ?>" 
                                 class="span4" type="text" placeholder="Chairman"
                                 value="<?php echo $conf[CONFERENCE_CHAIRMAN]; ?>">
                        </div>
                      </div>
                        
                        <div class="control-group">
                        <label class="control-label">
                          Chairman's Position
                        </label>
                        <div class="controls">
                          <input name="<?php echo CHAIRMAN_POSITION; ?>" id="<?php echo CHAIRMAN_POSITION; ?>"
                              class="span4" type="text" placeholder="E.g. Vice-Chancellor, UI"
                              value="<?php echo $conf[CHAIRMAN_POSITION]; ?>">
                        </div>
                      </div>
                      
                      <div class="form-actions no-margin">
                          <input type="hidden" name="<?php echo CONFERENCE_ID; ?>" value="<?php echo $conf[CONFERENCE_ID]; ?>">
                        <button name="Save" type="submit" class="btn btn-info pull-left">
                          Update
                        </button>
                        <div class="clearfix">
                        </div>
                      </div>
                      
                    </form>
                      
                      
                      
                      
                      
                      <form action="" method="post" enctype="multipart/form-data" class="form-horizontal no-margin">
                        <div class="control-group">
                        <div class="controls controls-row">
                          <?php //print_r($conf); ?>
                          <?php if(isset($response2)) print_r($response2); ?>
                        </div>
                      </div>
                      
                        
                        <div class="control-group">
                        <label class="control-label">
                          Current Photo
                        </label>
                        <div class="controls">
                            <img  src="../images/uploads/confs/<?php echo $conf[LOGO]; ?>"/>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">
                          New Logo
                        </label>
                        <div class="controls">
                            <input class="filename" type="file" name="<?php echo LOGO; ?>" id="<?php echo LOGO; ?>">
                        </div>
                      </div>
                      
                      <div class="form-actions no-margin">
                          <input type="hidden" name="<?php echo CONFERENCE_ID; ?>" value="<?php echo $conf[CONFERENCE_ID]; ?>">
                        <button name="Upload" type="submit" class="btn btn-info pull-left">
                          Update Photo
                        </button>
                        <div class="clearfix">
                        </div>
                      </div>
                      
                    </form>
                      
                    
                      <div id="dt_example" class="example_alt_pagination">
                          <h2>Activities</h2> 
                          <a href="addactivity.php?confid=<?php echo $conf[CONFERENCE_CODE]; ?>">
                          Add New Activity
                          </a>
                    <?php //print_r($conferences);?>
                      <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                        <thead>
                          <tr>
                          	<th width="4%">#</th>
                            <th>
                              Date
                            </th>
                            <th width="18%" style="width:17%">
                              Activity
                            </th>
                            <th width="21%" style="width:20%">
                              Start</th>
                            <th width="17%" class="hidden-phone" style="width:16%">
                              End
                            </th>
                            <th width="22%">
                            	Manage
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($activities as $con){
                             ?>
                            <tr class="<?php echo $i%2==0?"gradeX warning":"gradeC"; ?>">
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $util->getFriendlyDate($con[START_TIME]);; ?></td>
                                <td><?php echo $con[DAY_TITLE]; ?></td>
                                <td><?php echo date("g:i a",$con[START_TIME]); ?></td>
                                <td><?php echo date("g:i a",$con[END_TIME]); ?></td>
                                <td class="hidden-phone">
                                <p> 
                                    <a href="editactivity.php?id=<?php echo base64_encode($con[CONFERENCE_DETAIL_ID]); ?>">
                                        <button class="btn btn-primary btn-mini">
                                            <i class="icon-pencil icon-white">
                                            </i>Edit
                                        </button>
                                    </a>
                                    <a href="toggleconference.php?action=deleteconfdetail&id=<?php echo base64_encode($con[CONFERENCE_DETAIL_ID]); ?>" onclick="return validateDeletion();" >
                                        <button  class="btn btn-danger btn-mini">
                                            <i class="icon-remove icon-white">        
                                            </i> Delete
                                        </button>
                                    </a>
                                </p>
                                </td>
                                <td class="hidden-phone">
                                    <?php if($con[CURRENT]=='0') {?>
                                    <a href="toggleconference.php?action=current&id=<?php echo $con[CONFERENCE_CODE]; ?>">
                                        <button class="btn btn-mini"> Set</button>
                                    </a>
                                    <?php }?>
                                </td>
                          </tr>
                            <?php
                                $i++;
                                }
                            ?>
                          
                        </tbody>
                      </table>
                      <div class="clearfix">
                      </div>
                    </div>
                      
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
