<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Constants.php';
require_once '../classes/Administrator.php';
require_once '../classes/Publications.php';
require_once '../classes/Utilities.php';
require_once '../classes/Conference.php';

new Database();
new Constants();
$admin = new Administrator();
$publi = new Publication();
$util = new Utilities();
$admin->validateLogin();


if(isset($_POST['Save'])){
    $response = $publi->createJournal();
}

$journals = $publi->getJournals();

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
				<h1>MANAGING JOURNALS</h1>
			</div>
			
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <div id="breadcrumb">
                            <a href="adhome.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Journals</a>
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
                          <?php if(isset($response)) echo $response; ?>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">
                          Journal name
                        </label>
                        <div class="controls controls-row">
                            <input class="span6" type="text" placeholder="Journal title" 
                                   name="<?php echo JOURNAL_TITLE; ?>" id="<?php echo JOURNAL_TITLE; ?>"
                                   value="<?php echo $_POST[JOURNAL_TITLE]; ?>">
                        </div>
                      </div>

                    <div class="control-group">
                        <label class="control-label">
                          ISBN
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="ISBN"
                                 name="<?php echo JOURNAL_ISBN; ?>" id="<?php echo JOURNAL_ISBN; ?>"
                                 value="<?php echo $_POST[JOURNAL_ISBN]; ?>">
                        </div>
                      </div>

                       <div class="control-group">
                        <label class="control-label" for="PublishDate">Publish Date </label>
                        <div class="controls controls-row">
                          <select name="<?php echo JOURNAL_MONTH; ?>" id="<?php echo JOURNAL_MONTH; ?>" class="span2">
                              <option value="">
                              - Month -
                              </option>
                              <?php
                                foreach($util->getMonths() as $key => $val){
                              ?>
                              <option <?php if($_POST[JOURNAL_MONTH]==$key) echo "selected='selected'"; ?> 
                                  value="<?php echo $key; ?>"><?php echo $val; ?></option>
                              <?php }?>
                          </select>
                          <select name="<?php echo JOURNAL_DAY; ?>" id="<?php echo JOURNAL_DAY; ?>"  class="span2 input-left-top-margins">
                              <option value="">
                              - Day -
                            </option>
                            <?php
                                for($i=1;$i<=31;$i++){
                              ?>
                              <option <?php if($_POST[JOURNAL_DAY]==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php }?>
                          </select>
                          
                          <select name="<?php echo JOURNAL_YEAR; ?>" id="<?php echo JOURNAL_YEAR; ?>" class="span2 input-left-top-margins">
                              <option value="">
                              - Year -
                            </option>
                            <?php
                                for($i=1990;$i<=date("Y")+4;$i++){
                              ?>
                              <option <?php if($_POST[JOURNAL_YEAR]==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php }?>
                          </select>
                          
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">
                          Authors
                        </label>
                        <div class="controls">
                          <textarea name="<?php echo JOURNAL_AUTHORS; ?>" id="<?php echo JOURNAL_AUTHORS; ?>" class="span6 input-left-top-margins" type="text" 
                                    placeholder=""><?php echo $_POST[JOURNAL_AUTHORS]; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">Publisher Details
                        </label>
                        <div class="controls controls-row">
                          <textarea name="<?php echo PUBLISHER_DETAILS; ?>" id="<?php echo PUBLISHER_DETAILS; ?>" class="span6 input-left-top-margins" type="text" 
                                    placeholder=""><?php echo $_POST[PUBLISHER_DETAILS]; ?></textarea>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Abstract
                        </label>
                        <div class="controls controls-row">
                          <textarea name="<?php echo JOURNAL_ABSTRACT; ?>" id="<?php echo JOURNAL_ABSTRACT; ?>" class="span6 input-left-top-margins" type="text" 
                                    placeholder="" ><?php echo $_POST[JOURNAL_ABSTRACT]; ?></textarea>
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
                          	<th width="4%">#</th>
                            <th width="18%" style="width:17%">
                              Journal Title
                            </th>
                            <th width="18%" style="width:17%">
                              Author(s)</th>
                            <th width="21%" style="width:20%">
                              ISBN</th>
                            <th width="17%" class="hidden-phone" style="width:16%">
                              Publish Date</th>
                            
                            <th width="22%">
                            	Manage
                            </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                foreach($journals as $jour){
                             ?>
                            <tr class="<?php echo $i%2==0?"gradeX warning":"gradeC"; ?>">
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $jour[JOURNAL_TITLE]; ?></td>
                                <td><?php echo $jour[JOURNAL_AUTHORS]; ?></td>
                                <td><?php echo $jour[JOURNAL_ISBN]; ?></td>
                                <td><?php echo $util->getFriendlyDate($jour[JOURNAL_DATE]); ?></td>
                                <td class="hidden-phone">
                                    <p>
                                        <a href="editjournal.php?id=<?php echo $jour[JOURNALS_ID]; ?>"><button class="btn btn-primary btn-mini"><i class="icon-pencil icon-white"></i> Edit</button></a>
                                        <a href="togglepublications.php?pubaction=deleteJ&id=<?php echo $jour[JOURNALS_ID]; ?>" onclick="return validateDeletion();" ><button  class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i> Delete</button></a>
                                </p>
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
