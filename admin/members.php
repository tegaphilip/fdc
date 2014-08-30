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


//$conferences = $conference->getConferences();
$members = $db->getWhere(MEMBERS,null,array(FIRST_NAME=>"ASC"));


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
				<h1>MEMBERS</h1>
			</div>
			<div id="breadcrumb">
				<a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Members</a>
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
                            <th>Gender</th>
                            <th>Profession</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Affiliation</th>
                            <th>Status</th>
                            <th>Date Registered</th>
                            <th>Manage</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($members as $con){
                             ?>
                            <tr class="<?php echo $i%2==0?"gradeX warning":"gradeC"; ?>">
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $con[TITLE]." ".$con[FIRST_NAME]." ".$con[OTHER_NAMES]." ".$con[LAST_NAME]; ?></td>
                                <td><?php echo $con[GENDER]; ?></td>
                                <td><?php echo $con[PROFESSION]; ?></td>
                                <td><a href="mailto:<?php echo $con[EMAIL]; ?>"><?php echo $con[EMAIL]; ?></a></td>
                                <td><?php echo $con[TELEPHONE];?></td>
                                <td><?php $st = $db->getWhere(STATES, array(STATE_ID=>$con[STATE_ID])); echo $st[0][STATE_NAME];?></td>
                                <td><?php $st = $db->getWhere(COUNTRIES, array(COUNTRY_ID=>$con[COUNTRY_ID])); echo $st[0][COUNTRY_NAME];?></td>
                                <td><?php $affi =  $aff->getAffiliationDetailsByID($con[AFFILIATION_ID]); 
                                    echo $affi[AFFILIATION_NAME];?>
                                </td>
                                <td>
                                    <a title="Click to change" href="toggle.php?action=togglememberstatus&id=<?php echo $con[MEMBER_CODE]; ?>">
                                        <?php echo $con[MEMBER_STATUS]=="0"?"<font color='red'>Inactive</font>":"<font color='blue'>Active</font>"; ?>
                                    </a>
                                </td>
                                <td><?php echo $util->getFriendlyDate($con[DATE_REGISTERED]); ?></td>
                                <td class="hidden-phone">
                                    <a title="Delete" href="toggle.php?action=deletemember&id=<?php echo $con[MEMBER_CODE]; ?>" onclick="return validateDeletion();" >
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
