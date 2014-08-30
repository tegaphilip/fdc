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
    $response = $publi->updateBOOK();
}

if(isset($_POST['UploadCover'])){
    $response2 = $publi->uploadBookCover();
}

if(isset($_POST['UploadDocument'])){
    $response3 = $publi->uploadBookDoc();
}

$editID = $_GET['id'];
$bk = $util->getDetails(BOOKS, BOOKS_ID, $_GET['id']);

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
				<h1>MANAGING BOOKS</h1>
			</div>
			<div class="container-fluid">
			  <div class="row-fluid">
			  <div class="span12">
			    <div class="widget-box">
	    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
	      <div id="breadcrumb">
                            <a href="adhome.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
				<a href="#" class="current">Update Books</a>
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
                          Book name
                        </label>
                        <div class="controls controls-row">
                            <input class="span6" type="text" placeholder="Book title" 
                                   name="<?php echo BOOK_TITLE; ?>" id="<?php echo BOOK_TITLE; ?>"
                                   value="<?php echo $bk[BOOK_TITLE]; ?>">
                            <input type="hidden" name="<?php echo BOOKS_ID;?>" id="<?php echo BOOKS_ID;?>"
                                          value="<?php echo $bk[BOOKS_ID]; ?>">
                        </div>
                      </div>
		<input type="hidden" name="<?php echo BOOKS_ID;?>" id="<?php echo BOOKS_ID;?>" value="<?php echo $editID;?>">
                    <div class="control-group">
                        <label class="control-label">
                          ISBN
                        </label>
                        <div class="controls">
                          <input class="span4" type="text" placeholder="ISBN"
                                 name="<?php echo BOOK_ISBN; ?>" id="<?php echo BOOK_ISBN; ?>"
                                 value="<?php echo $bk[BOOK_ISBN]; ?>">
                        </div>
                      </div>
                      <?php
                            $day = date("d",$bk[BOOK_DATE]);
                            $month = date("m",$bk[BOOK_DATE]);
                            $year = date("Y",$bk[BOOK_DATE]);
                      ?>
                       <div class="control-group">
                        <label class="control-label" for="PublishDate">Publish Date </label>
                        <div class="controls controls-row">
                          <select name="<?php echo BOOK_MONTH; ?>" id="<?php echo BOOK_MONTH; ?>" class="span2">
                              <option value="">
                              - Month -
                              </option>
                              <?php
                                foreach($util->getMonths() as $key => $val){
                              ?>
                              <option <?php if($month==$key) echo "selected='selected'"; ?> 
                                  value="<?php echo $key; ?>"><?php echo $val; ?></option>
                              <?php }?>
                          </select>
                          <select name="<?php echo BOOK_DAY; ?>" id="<?php echo BOOK_DAY; ?>"  class="span2 input-left-top-margins">
                              <option value="">
                              - Day -
                            </option>
                            <?php
                                for($i=1;$i<=31;$i++){
                              ?>
                              <option <?php if($day==$i) echo "selected='selected'"; ?> 
                                  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php }?>
                          </select>
                          
                          <select name="<?php echo BOOK_YEAR; ?>" id="<?php echo BOOK_YEAR; ?>" class="span2 input-left-top-margins">
                              <option value="">
                              - Year -
                            </option>
                            <?php
                                for($i=date("Y")-4;$i<=date("Y")+4;$i++){
                              ?>
                              <option <?php if($year==$i) echo "selected='selected'"; ?> 
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
                          <textarea name="<?php echo BOOK_AUTHORS; ?>" id="<?php echo BOOK_AUTHORS; ?>" class="span6 input-left-top-margins" type="text" 
                                    placeholder=""><?php echo $bk[BOOK_AUTHORS]; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">Publisher Details
                        </label>
                        <div class="controls controls-row">
                          <textarea name="<?php echo PUBLISHER_DETAILS; ?>" id="<?php echo PUBLISHER_DETAILS; ?>" class="span6 input-left-top-margins" type="text" 
                                    placeholder=""><?php echo $bk[PUBLISHER_DETAILS]; ?></textarea>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Abstract
                        </label>
                        <div class="controls controls-row">
                          <textarea name="<?php echo BOOK_ABSTRACT; ?>" id="<?php echo BOOK_ABSTRACT; ?>" class="span6 input-left-top-margins" type="text" 
                                    placeholder="" ><?php echo $bk[BOOK_ABSTRACT]; ?></textarea>
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
                    
                    
                     <form action="" method="post" enctype="multipart/form-data" class="form-horizontal no-margin">
                         <fieldset>
                             <legend>Book Cover</legend>
                         <div class="control-group">
                        <div class="controls controls-row">
                          <?php //print_r($conf); ?>
                          <?php if(isset($response2)) print_r($response2); ?>
                        </div>
                      </div>
                      
                        
                        <div class="control-group">
                        <label class="control-label">
                          Current Cover
                              <?php  echo empty($bk[BOOK_COVER])?"(Default)":""; ?>
                        </label>
                        <div class="controls">
                            <?php $pdf = empty($bk[BOOK_COVER])?"default.pdf":$bk[BOOK_COVER]; ?>
                            <div id="embeddedpdf" align="center">
                    <!-- Embed PDF File -->
                    <OBJECT data="../uploadedfiles/books/<?php echo $pdf; ?>" 
                            TYPE="application/x-pdf" TITLE="<?php echo $bk[BOOK_TITLE]; ?>" WIDTH=940 HEIGHT=700>
                      <embed src="../uploadedfiles/books/<?php echo $pdf; ?>" width="300" height="250"></embed>
                    </object>
                 </div>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">
                          New Cover (pdf)
                        </label>
                        <div class="controls">
                            <input class="filename" type="file" name="<?php echo BOOK_COVER; ?>" id="<?php echo BOOK_COVER; ?>">
                        </div>
                      </div>
                      
                             <div class="control-group">
                        <label class="control-label">
                          
                        </label>
                        <div class="controls">
                            <?php if(!empty($bk[BOOK_COVER])){ ?>
                      <span>
                          <a title="View Cover" target="_blank" href="uploadedfiles/books/<?php echo $bk[BOOK_COVER]; ?>">
                              <img src="../images/pdf.png" />
                          </a>
                      </span>
                      <?php }?>
                        </div>
                      </div>
                      <div class="form-actions no-margin">
                          <input type="hidden" name="<?php echo ID; ?>" value="<?php echo $bk[ID]; ?>">
                        <button name="UploadCover" type="submit" class="btn btn-info pull-left">
                          Update Cover
                        </button>
                        <div class="clearfix">
                        </div>
                      </div>
                             
                        
                         </fieldset>
                    </form>
                    
                    
                    
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal no-margin">
                         <fieldset>
                             <legend>Complete Book</legend>
                         <div class="control-group">
                        <div class="controls controls-row">
                          <?php //print_r($conf); ?>
                          <?php if(isset($response3)) print_r($response3); ?>
                        </div>
                      </div>
                      
                        
                        <div class="control-group">
                        <label class="control-label">
                          Current Book
                              <?php  echo empty($bk[BOOK_DOC])?"(Default)":""; ?>
                        </label>
                        <div class="controls">
                            <?php $pdf = empty($bk[BOOK_DOC])?"default.pdf":$bk[BOOK_DOC]; ?>
                            <div id="embeddedpdf" align="center">
                    <!-- Embed PDF File -->
                    <OBJECT data="../uploadedfiles/books/<?php echo $pdf; ?>" 
                            TYPE="application/x-pdf" TITLE="<?php echo $bk[BOOK_TITLE]; ?>" WIDTH=940 HEIGHT=700>
                      <embed src="../uploadedfiles/books/<?php echo $pdf; ?>" width="300" height="250"></embed>
                    </object>
                 </div>
                        </div>
                      </div>
                      
                      <div class="control-group">
                        <label class="control-label">
                          Change full book (pdf only)
                        </label>
                        <div class="controls">
                            <input class="filename" type="file" name="<?php echo BOOK_DOC; ?>" id="<?php echo BOOK_DOC; ?>">
                        </div>
                      </div>
                      
                     <div class="control-group">
                        <label class="control-label">
                          
                        </label>
                        <div class="controls">
                            <?php if(!empty($bk[BOOK_DOC])){ ?>
                      <span>
                          <a title="View Book" target="_blank" href="uploadedfiles/books/<?php echo $bk[BOOK_DOC]; ?>">
                              <img src="../images/pdf.png" />
                          </a>
                      </span>
                      <?php }?>
                        </div>
                      </div>
                             
                      <div class="form-actions no-margin">
                          <input type="hidden" name="<?php echo ID; ?>" value="<?php echo $bk[ID]; ?>">
                        <button name="UploadDocument" type="submit" class="btn btn-info pull-left">
                          Update Document (Full Book)
                        </button>
                        <div class="clearfix">
                        </div>
                      </div>
                         </fieldset>
                    </form>
                    
                  </div>
                </div>
              </div>
          </div>
                                <!--widget form end-->
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
