<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Utilities.php';
require_once '../classes/Conference.php';

$db = new Database();
new Constants();
$admin = new Administrator();
$admin->validateLogin();


if(isset($_POST['Save'])){
    $response = $admin->addNewAdmin();
}

$administrators = $admin->getAdministrators();

?>

<!DOCTYPE html>
<html lang="en">
	
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
				<h1>MANAGING ADMINISTRATORS</h1>
			</div>
			
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <div id="breadcrumb">
                            <a href="adhome.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Add New Admin</a>
			</div>
          </div>
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
                    <!--FORMSSSSSSS-->
                    <form class="form-horizontal no-margin" method="post" action="">
                        <div class="control-group">
                        <div class="controls controls-row">
                            <h4>ADD A NEW ADMIN</h4>
                        </div>
                      </div>
                        <div class="control-group">
                        <div class="controls controls-row">
                          <?php if(isset($response)) echo $response; ?>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">
                          Name
                        </label>
                        <div class="controls controls-row">
                            <input class="span6" type="text" placeholder="Admin Name" 
                                   name="<?php echo FULL_NAME; ?>" id="<?php echo FULL_NAME; ?>"
                                   value="<?php echo $_POST[FULL_NAME]; ?>">
                        </div>
                      </div>

                    <div class="control-group">
                        <label class="control-label">
                          Username
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="Username"
                                 name="<?php echo USERNAME; ?>" id="<?php echo USERNAME; ?>"
                                 value="<?php echo $_POST[USERNAME]; ?>">
                        </div>
                      </div>
                        
                      <div class="control-group">
                        <label class="control-label">
                          Email
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="Email"
                                 name="<?php echo EMAIL; ?>" id="<?php echo EMAIL; ?>"
                                 value="<?php echo $_POST[EMAIL]; ?>">
                        </div>
                      </div>  
                        
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
                        
                        <!--begin all journal-->
                       <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title">
                <span class="icon"></span>
	      <h5></h5><div class="buttons"></div></div>
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
                          	<th>#</th>
                            <th >
                              Full Name
                            </th>
                            <th >
                              Email
                            </th>
                            <th >
                              Username</th>
                            <th class="hidden-phone" >
                              Status</th>
                            <th colspan="2">
                            	Manage
                            </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($administrators as $jour){
                             ?>
                            <tr class="<?php echo $i%2==0?"gradeX warning":"gradeC"; ?>">
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $jour[FULL_NAME]; ?></td>
                                <td><a href="mailto:<?php echo $jour[EMAIL]; ?>"><?php echo $jour[EMAIL]; ?></a></td>
                                <td><?php echo $jour[USERNAME]; ?></td>
                                <td>
                                    <a title="Click to change" href="toggle.php?action=toggleadminstatus&id=<?php echo $jour[ADMIN_CODE]; ?>">
                                        <?php echo $jour[ADMIN_STATUS]=="0"?"<font color='red'>Inactive</font>":"<font color='blue'>Active</font>"; ?>
                                    </a>
                                </td>
                                <td class="hidden-phone">
                                    <a href="updateprofile.php?id=<?php echo base64_encode($jour[ADMIN_ID]); ?>" title="Update Profile">
                                            <img src="../images/edit.png"/>
                                        </a>
                                </td>
                                <td class="hidden-phone">
                                    <a title="Delete" href="toggle.php?action=deleteadmin&id=<?php echo $jour[ADMIN_CODE]; ?>" onclick="return validateDeletion();" >
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
                        <!--end all journals-->
                        				
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
