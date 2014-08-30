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
				<h1>MANAGING MEMBERS</h1>
			</div>
			<div id="breadcrumb">
				<a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Members List</a>
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
                    
                      <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                        <thead>
                          <tr>
                          	<th>#</th>
                            <th style="width:17%">
                              Month
                            </th>
                            <th style="width:20%">
                              Internet Explorer
                            </th>
                            <th style="width:16%">
                              Firefox
                            </th>
                            <th style="width:16%" class="hidden-phone">
                              Chrome
                            </th>
                            <th style="width:16%" class="hidden-phone">
                              Safari
                            </th>
                            <th style="width:16%" class="hidden-phone">
                              Opera
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="gradeX warning">
                          	<td>1</td>
                            <td>
                              December
                            </td>
                            <td>
                              14.7 %
                            </td>
                            <td>
                              31.1 %
                            </td>
                            <td class="hidden-phone">
                              46.9 %
                            </td>
                            <td class="hidden-phone">
                              4.2 %
                            </td>
                            <td class="hidden-phone">
                              2.1 %
                            </td>
                          </tr>
                          <tr class="gradeC">
                          <td>
                             1
                            </td>
                            <td>
                              November
                            </td>
                            <td>
                              15.1 %
                            </td>
                            <td>
                              31.2 %
                            </td>
                            <td class="hidden-phone">
                              46.3 %
                            </td>
                            <td class="hidden-phone">
                              4.4 %
                            </td>
                            <td class="hidden-phone">
                              2.0 %
                            </td>
                          </tr>
                         
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
