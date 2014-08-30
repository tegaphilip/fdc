<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Linkage.php';
require_once '../classes/Utilities.php';
require_once '../classes/Conference.php';

new Database();
new Constants();
$admin = new Administrator();
$linkage = new Linkage();
$admin->validateLogin();


if(isset($_POST['Save'])){
    $response = $linkage->addLinkage();
}

$linkages = $linkage->getLinkages();

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
				<h1>MANAGING LINKAGES</h1>
			</div>
			
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <div id="breadcrumb">
                            <a href="adhome.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Add New Linkage</a>
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
                            <h4>ADD A NEW LINKAGE</h4>
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
                            <input class="span6" type="text" placeholder="Linkage Name" 
                                   name="<?php echo LINKAGE_NAME; ?>" id="<?php echo LINKAGE_NAME; ?>"
                                   value="<?php echo $_POST[LINKAGE_NAME]; ?>">
                        </div>
                      </div>

                    <div class="control-group">
                        <label class="control-label">
                          Website
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="e.g www.podnetwork.org"
                                 name="<?php echo LINKAGE_URL; ?>" id="<?php echo LINKAGE_URL; ?>"
                                 value="<?php echo $_POST[LINKAGE_URL]; ?>">
                        </div>
                      </div>

                            <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls docs-input-sizes">
                                        <textarea name="<?php echo CONTACT_ADDRESS; ?>" rows="4" id="textarea"  placeholder="" cols="50"><?php echo $_POST[CONTACT_ADDRESS]; ?></textarea>
                                    </div>
                                </div>
                        <div class="control-group">
						<label class="control-label">Telephone</label>
						<div class="controls docs-input-sizes">
						  <input value="<?php echo $_POST[TELEPHONE]; ?>" name="<?php echo TELEPHONE; ?>" type="text" class="span4" id="<?php echo TELEPHONE; ?>" placeholder="Phone number">
						</div>
					  </div>
                         <div class="control-group">
						<label class="control-label">Fax:</label>
						<div class="controls docs-input-sizes">
                        <input value="<?php echo $_POST[FAX]; ?>" name="<?php echo FAX; ?>" type="text" class="span4" id="<?php echo FAX; ?>" >
                        </div>
					  </div>
                                        
                        <div class="control-group">
						<label class="control-label">P.O. Box:</label>
						<div class="controls docs-input-sizes">
                        <input value="<?php echo $_POST[POBOX]; ?>" name="<?php echo POBOX; ?>" type="text" class="span4" id="<?php echo POBOX; ?>">
                        </div>
					  </div>
                        
                        <div class="control-group">
						<label class="control-label">Activate:</label>
						<div class="controls docs-input-sizes">
                         <input type="checkbox" value="1" 
                                name="<?php echo ACTIVATION_STATUS; ?>"  class="span4" 
                                id="<?php echo ACTIVATION_STATUS; ?>" <?php if($_POST[ACTIVATION_STATUS]=="1") echo "checked='checked'"; ?>>
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
                          	<th>#</th>
                            <th >
                              Linkage Name
                            </th>
                            <th >
                              Website</th>
                            <th >
                              Activation Status</th>
                            <th class="hidden-phone" >
                              Address</th>
                            <th class="hidden-phone" >
                              Fax</th>
                            <th class="hidden-phone" >
                              Telephone</th>
                            <th class="hidden-phone" >
                              POBOX</th>
                            
                            <th colspan="2">
                            	Manage
                            </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($linkages as $jour){
                             ?>
                            <tr class="<?php echo $i%2==0?"gradeX warning":"gradeC"; ?>">
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $jour[LINKAGE_NAME]; ?></td>
                                <td><?php echo $jour[LINKAGE_URL]; ?></td>
                                <td><?php echo $jour[ACTIVATION_STATUS]=="1"?"<font color='blue'>Active</font>":"<font color='red'>Inactive</font>"; ?></td>
                                <td><?php echo $jour[CONTACT_ADDRESS]; ?></td>
                                <td><?php echo $jour[FAX]; ?></td>
                                <td><?php echo $jour[TELEPHONE]; ?></td>
                                <td><?php echo $jour[POBOX]; ?></td>
                                <td class="hidden-phone">
                                    <a href="edit_linkage.php?id=<?php echo $jour[LINKAGE_CODE]; ?>" title="Update Details">
                                            <img src="../images/edit.png"/>
                                        </a>
                                </td>
                                <td class="hidden-phone">
                                    <a title="Delete" href="toggle.php?action=deletelinkage&id=<?php echo $jour[LINKAGE_CODE]; ?>" onclick="return validateDeletion();" >
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
