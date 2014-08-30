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


$conferences = $conference->getConferences();


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
				<h1>MANAGE CONFERENCES</h1>
			</div>
			<div id="breadcrumb">
				<a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Conferences</a>
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
                      <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                        <thead>
                          <tr>
                          	<th width="4%">#</th>
                            <th width="18%" style="width:17%">
                              Conference Title
                            </th>
                            <th width="18%" style="width:17%">
                              Amount</th>
                            <th width="21%" style="width:20%">
                              Start Date</th>
                            <th width="17%" class="hidden-phone" style="width:16%">
                              End Date</th>
                            <th>
                                Current
                            </th>
                            <th width="22%">
                            	Manage
                            </th>
                            <th>
                                Set Current
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($conferences as $con){
                             ?>
                            <tr class="<?php echo $i%2==0?"gradeX warning":"gradeC"; ?>">
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $con[CONFERENCE_TITLE]; ?></td>
                                <td><?php echo number_format($con[AMOUNT_CHARGED],2); ?></td>
                                <td><?php echo $util->getFriendlyDate($con[START_DATE]); ?></td>
                                <td class="hidden-phone"><?php echo $util->getFriendlyDate($con[END_DATE]); ?></td>
                                <td class="hidden-phone"><?php echo $con[CURRENT]=='1'?"<img src='../images/apply.png' />":""; ?></td>
                                <td class="hidden-phone">
                                    <p>
                                        <a target="_blank" href="../conference.php?id=<?php echo $con[CONFERENCE_CODE]; ?>"><button class="btn btn-mini"><i class="icon-eye-open"></i> View</button></a>
                                        <a href="editconference.php?id=<?php echo $con[CONFERENCE_CODE]; ?>"><button class="btn btn-primary btn-mini"><i class="icon-pencil icon-white"></i> Edit</button></a>
                                        <a href="toggleconference.php?action=delete&id=<?php echo $con[CONFERENCE_CODE]; ?>" onclick="return validateDeletion();" ><button  class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i> Delete</button></a>
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
