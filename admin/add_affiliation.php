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
$aff = new Affiliation();
$admin->validateLogin();


if(isset($_POST['Save'])){
    $response = $aff->addNewAffiliation();
}

$affiliations = $aff->getAffiliations();
$states = $db->getWhere(STATES, null, array(STATE_NAME=>"ASC"));

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
				<h1>MANAGING AFFILIATIONS</h1>
			</div>
			
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <div id="breadcrumb">
                            <a href="adhome.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Add New Affiliations</a>
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
                            <h4>ADD A NEW AFFILIATION</h4>
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
                            <input class="span6" type="text" placeholder="Affiliation Name" 
                                   name="<?php echo AFFILIATION_NAME; ?>" id="<?php echo AFFILIATION_NAME; ?>"
                                   value="<?php echo $_POST[AFFILIATION_NAME]; ?>">
                        </div>
                      </div>

                    <div class="control-group">
                        <label class="control-label">
                          Website
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="e.g www.ui.edu.ng"
                                 name="<?php echo URL; ?>" id="<?php echo URL; ?>"
                                 value="<?php echo $_POST[URL]; ?>">
                        </div>
                      </div>

                            <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls docs-input-sizes">
                                        <textarea name="<?php echo CONTACT_ADDRESS; ?>" rows="4" id="textarea"  placeholder="" cols="50"><?php echo $_POST[CONTACT_ADDRESS]; ?></textarea>
                                    </div>
                                </div>
                        
                        <div class="control-group">
						<label class="control-label">State</label>
						<div class="controls docs-input-sizes">
						  <select name="<?php echo STATE_ID; ?>" id="<?php echo STATE_ID; ?>">
                             <?php
                             foreach ($states as $state) 
                             {
                             ?>
                                <option <?php if($_POST[STATE_ID]==$state[STATE_ID]) echo "selected='selected'"; ?>
                                    value="<?php echo $state[STATE_ID]; ?>">
                                    <?php echo $state[STATE_NAME]; ?>
                                </option>
                             <?php
                             }
                             ?>
                          </select>
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
                              Affiliation Name
                            </th>
                            <th >
                              URL
                            </th>
                            <th >
                              State</th>
                            <th class="hidden-phone" >
                              Address</th>
                            <th colspan="2">
                            	Manage
                            </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($affiliations as $jour){
                             ?>
                            <tr class="<?php echo $i%2==0?"gradeX warning":"gradeC"; ?>">
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $jour[AFFILIATION_NAME]; ?></td>
                                <td><?php echo $jour[URL]; ?></td>
                                <td><?php $st = $db->getWhere(STATES, array(STATE_ID=>$jour[STATE_ID])); 
                                echo $st[0][STATE_NAME]; ?></td>
                                <td><?php echo $jour[CONTACT_ADDRESS]; ?></td>
                                <td class="hidden-phone">
                                    <a href="edit_affiliation.php?id=<?php echo $jour[AFFILIATION_CODE]; ?>" title="Update Details">
                                            <img src="../images/edit.png"/>
                                        </a>
                                </td>
                                <td class="hidden-phone">
                                    <a title="Delete" href="toggle.php?action=deleteaffiliation&id=<?php echo $jour[AFFILIATION_CODE]; ?>" onclick="return validateDeletion();" >
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
