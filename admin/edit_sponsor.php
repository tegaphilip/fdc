<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Sponsor.php';
require_once '../classes/Utilities.php';
require_once '../classes/Conference.php';

$db = new Database();
new Constants();
$admin = new Administrator();
$sponsor = new Sponsor();
$util = new Utilities();
$admin->validateLogin();


if(isset($_POST['Save'])){
    $response = $sponsor->editSponsor();
}

if(isset($_POST['Upload'])){
    $response2 = $sponsor->updateLogo();
}

$thisSponsor = $db->getWhere(SPONSORS, array(SPONSOR_CODE=>$_GET[ID]));
$thisSponsor = $thisSponsor[0];

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
				<h1>MANAGING SPONSORS</h1>
			</div>
			
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <div id="breadcrumb">
                            <a href="adhome.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                            <a href="add_sponsor.php" title="Sponsors" class="tip-bottom"> All Sponsors</a>
				<a href="#" class="current">Edit Sponsor "<?php echo $thisSponsor[SPONSOR_NAME]; ?>"</a>
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
                            <input class="span6" type="text" placeholder="Sponsor Name" 
                                   name="<?php echo SPONSOR_NAME; ?>" id="<?php echo SPONSOR_NAME; ?>"
                                   value="<?php echo $thisSponsor[SPONSOR_NAME]; ?>">
                        </div>
                      </div>

                    <div class="control-group">
                        <label class="control-label">
                          Website
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="e.g www.nafdac.com"
                                 name="<?php echo SPONSOR_URL; ?>" id="<?php echo SPONSOR_URL; ?>"
                                 value="<?php echo $thisSponsor[SPONSOR_URL]; ?>">
                        </div>
                      </div>

                            <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls docs-input-sizes">
                                        <textarea name="<?php echo CONTACT_ADDRESS; ?>" rows="4" id="textarea"  placeholder="" cols="50"><?php echo $thisSponsor[CONTACT_ADDRESS]; ?></textarea>
                                    </div>
                                </div>
                        <div class="control-group">
						<label class="control-label">Telephone</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $thisSponsor[TELEPHONE]; ?>" name="<?php echo TELEPHONE; ?>" type="text" class="span4" id="<?php echo TELEPHONE; ?>" placeholder="Phone number">
						</div>
					  </div>
                         <div class="control-group">
						<label class="control-label">Fax:</label>
						<div class="controls docs-input-sizes">
                        <input value="<?php echo $thisSponsor[FAX]; ?>" name="<?php echo FAX; ?>" type="text" class="span4" id="<?php echo FAX; ?>" >
                        </div>
					  </div>
                                        
                        <div class="control-group">
						<label class="control-label">P.O. Box:</label>
						<div class="controls docs-input-sizes">
                        <input value="<?php echo $thisSponsor[POBOX]; ?>" name="<?php echo POBOX; ?>" type="text" class="span4" id="<?php echo POBOX; ?>">
                        </div>
					  </div>
                        
                        <div class="control-group">
						<label class="control-label">Activate:</label>
						<div class="controls docs-input-sizes">
                         <input type="checkbox" value="1" 
                                name="<?php echo ACTIVATION_STATUS; ?>"  class="span4" 
                                id="<?php echo ACTIVATION_STATUS; ?>" <?php if($thisSponsor[ACTIVATION_STATUS]=="1") echo "checked='checked'"; ?>>
                        </div>
					  </div>
                        
                      <div class="form-actions no-margin">
                      <button name="Save" type="submit" class="btn btn-info pull-left">
                          <input type="hidden" name="<?php echo SPONSOR_ID; ?>" value="<?php echo $thisSponsor[SPONSOR_ID]; ?>">
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
                          Current Logo 
                              <?php  echo empty($thisSponsor[SPONSOR_LOGO])?"(Default)":""; ?>
                        </label>
                        <div class="controls">
                            <?php $src = empty($thisSponsor[SPONSOR_LOGO])?"default.jpg":$thisSponsor[SPONSOR_LOGO]; ?>
                            <img  src="../images/uploads/sponsors/<?php echo $src; ?>"/>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">
                          New Logo
                        </label>
                        <div class="controls">
                            <input class="filename" type="file" name="<?php echo SPONSOR_LOGO; ?>" id="<?php echo SPONSOR_LOGO; ?>">
                        </div>
                      </div>
                      
                      <div class="form-actions no-margin">
                          <input type="hidden" name="<?php echo SPONSOR_ID; ?>" value="<?php echo $thisSponsor[SPONSOR_ID]; ?>">
                        <button name="Upload" type="submit" class="btn btn-info pull-left">
                          Update Photo
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
