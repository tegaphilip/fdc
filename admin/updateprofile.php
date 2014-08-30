<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Affiliation.php';
require_once '../classes/Utilities.php';
require_once '../classes/Conference.php';

$db = new Database();
new Constants();
$admin = new Administrator();
$admin->validateLogin();


if(isset($_POST['Save'])){
    $response = $admin->editAdmin();
}

if(!isset($_GET[ID])){
    $_GET[ID] = $_SESSION[ADMIN_ID];
}else{
    $_GET[ID] = base64_decode($_GET[ID]);
}

$thisAdmin = $db->getWhere(ADMINISTRATORS, array(ADMIN_ID=>$_GET[ID]));
$thisAdmin = $thisAdmin[0];

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
                            <a href="admin.php" title="Administrators" class="tip-bottom"> All Admins</a>
				<a href="#" class="current">Edit Administrator "<?php echo $thisAdmin[FULL_NAME]; ?>"</a>
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
                          <?php if(isset($response)) print_r ($response); ?>
                            <?php  //print_r ($thisSponsor); ?>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">
                          Name
                        </label>
                        <div class="controls controls-row">
                            <input class="span6" type="text" 
                                   name="<?php echo FULL_NAME; ?>" id="<?php echo FULL_NAME; ?>"
                                   value="<?php echo $thisAdmin[FULL_NAME]; ?>">
                        </div>
                      </div>

                    <div class="control-group">
                        <label class="control-label">
                          Email
                        </label>
                        <div class="controls">
                          <input class="span4" type="text"
                                 name="<?php echo EMAIL; ?>" id="<?php echo EMAIL; ?>"
                                 value="<?php echo $thisAdmin[EMAIL]; ?>">
                        </div>
                      </div>
                        
                      <div class="control-group">
                        <label class="control-label">
                          Username
                        </label>
                        <div class="controls">
                          <input class="span4" type="text"
                                 name="<?php echo USERNAME; ?>" id="<?php echo USERNAME; ?>"
                                 value="<?php echo $thisAdmin[USERNAME]; ?>">
                        </div>
                      </div>
                        
                      <div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls docs-input-sizes">
                                <input name="<?php echo PASSWORD; ?>" type="password" class="span4" id="<?php echo PASSWORD; ?>"
                                       placeholder="leave this field blank if you dont want to change the password">
                            </div>
                        </div>	
                        
                        
                      <div class="form-actions no-margin">
                      <button name="Save" type="submit" class="btn btn-info pull-left">
                          <input type="hidden" name="<?php echo ADMIN_ID; ?>" value="<?php echo $thisAdmin[ADMIN_ID]; ?>">
                          Update
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
