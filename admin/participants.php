<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Conference.php';
require_once '../classes/Utilities.php';
require_once '../classes/Affiliation.php';


$db = new Database();
new Constants();
$admin = new Administrator();
$conference = new Conference();
$util = new Utilities();
$aff = new Affiliation();
$admin->validateLogin();


$conferences = $conference->getConferences();
$participants = $db->getWhere(CONFERENCE_ATTENDANCE,null,array(CONFERENCE_ID=>"ASC",FULL_NAME=>"ASC"));


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
				<h1>CONFERENCE PARTICIPANTS</h1>
			</div>
			<div id="breadcrumb">
				<a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Participants</a>
			</div>
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <h5>&nbsp;</h5><div class="buttons"><a href="#" class="btn btn-mini"><i class="icon-refresh"></i> Update stats</a></div></div>
							<div class="widget-content">
								
                                <!--tables-->
                                	 <div class="row-fluid">
              <div class="span12">
                <div class="widget">
                  <div class="widget-header">
                    
                    <span class="tools">
                      <a class="fs1" aria-hidden="true" data-icon="&#xe090;"></a>
                    </span>
                  </div>
                  <div class="widget-body">
                    <div id="dt_example" class="example_alt_pagination">
                    <?php //print_r($conferences);?>
                        <table style="font-size: 10px;" class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Conference</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Is a Member?</th>
                            <th>Affiliation</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date Registered</th>
                            <th>Payment Confirmed</th>
                            <th>Date Payment was Confirmed</th>
                            <th>Date Payment was made</th>
                            <th colspan="2">Manage</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($participants as $con){
                             ?>
                            <tr class="<?php echo $i%2==0?"gradeX warning":"gradeC"; ?>">
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $con[FULL_NAME]; ?></td>
                                <td><?php $thisCon = $util->getDetails(CONFERENCES, CONFERENCE_ID, $con[CONFERENCE_ID]);
                                echo $thisCon[CONFERENCE_TITLE]; ?></td>
                                <td><?php echo $con[EMAIL]; ?></td>
                                <td><?php echo $con[TELEPHONE];?></td>
                                <td><?php echo $con[IS_MEMBER]=="0"?"No":"Yes";?></td>
                                <td><?php $affi =  $aff->getAffiliationDetailsByID($con[AFFILIATION_ID]); 
                                echo $affi[AFFILIATION_NAME];?></td>
                                <td><?php echo $conference->getConferenceRegistrationTypeName($con[CONFERENCE_REGISTRATION_TYPE_ID]);?></td>
                                
                                <td><?php echo $con[AMOUNT_PAID];?></td>
                                <td><?php echo $util->getFriendlyDate($con[DATE_REGISTERED]); ?></td>
                                <td><?php echo $con[PAYMENT_CONFIRMED]=="1"?"Yes":"No";?></td>
                                <td><?php if(!empty($con[DATE_PAYMENT_WAS_CONFIRMED])) echo $util->getFriendlyDate($con[DATE_PAYMENT_WAS_CONFIRMED]); ?></td>
                                <td><?php if(!empty($con[DATE_PAYMENT_WAS_MADE])) echo $util->getFriendlyDate($con[DATE_PAYMENT_WAS_MADE]); ?></td>
                                
                                <td class="hidden-phone">
                                    <a href="editparticipant.php?id=<?php echo base64_encode($con[ATTENDEE_ID]); ?>" title="Update Details">
                                            <img src="../images/edit.png"/>
                                        </a>
                                </td>
                                <td class="hidden-phone">
                                    <a title="Delete" href="toggleconference.php?action=deleteparticipant&id=<?php echo base64_encode($con[ATTENDEE_ID]); ?>" onclick="return validateDeletion();" >
                                            <img src="../images/delete.png"/>
                                        </a>
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
                                <!--end-->
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
