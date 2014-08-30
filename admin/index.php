<?php
    session_start();
    require_once '../classes/Database.php';
    require_once '../classes/Constants.php';
    require_once '../classes/Administrator.php';
    
    new Database();
    new Constants();
    $admin = new Administrator();
    
    if(isset($_POST['btnlogin'])){
        $login_response = $admin->login();
    }else{
        $login_response = $_SESSION['transferer'];
        unset($_SESSION['transferer']);
    }
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>::FDC::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link id="switch_style" href="../bootstrap/css/united/bootstrap.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/jquery.rating.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <div class="container">
	<?php require_once('adheader.php');?>
      <br><br><br>
      <div class="row">
            <div class="span3 pull-left">&nbsp;</div>
            <div class="span6">
             	<h4 class="breadcrumb">ADMIN LOGIN</h4>
                
                
                	<!--make this error class be rendered by a method-->
                    <!--<div class="alert alert-block alert-error fade in">
                      <button data-dismiss="alert" class="close" type="button">
                        ×
                      </button>
                      <h4 class="alert-heading">
                        Error!
                      </h4>
                      <p>
                        Invalid login details!
                      </p>
                    </div>
                    
                      <div class="alert alert-block alert-warning fade in">
                      <button data-dismiss="alert" class="close" type="button">
                        ×
                      </button>
                      <h4 class="alert-heading">
                        Warning!
                      </h4>
                      <p>
                       Warning
                      </p>
                    </div>
                    
                    <div class="alert alert-block alert-success fade in">
                      <button data-dismiss="alert" class="close" type="button">
                        ×
                      </button>
                      <h4 class="alert-heading">
                        Success!
                      </h4>
                      <p>
                       Success
                      </p>
                    </div>
                    
                    <div class="alert alert-block alert-info fade in no-margin">
                      <button data-dismiss="alert" class="close" type="button">
                        ×
                      </button>
                      <h4 class="alert-heading">
                        Info!
                      </h4>
                      <p>
                         This is info
                      </p>
                    </div>-->
                    <!--error ends here-->
                    <?php
                        if(isset($login_response))
                               echo $login_response;
                    ?>
                <p><div id="loginbox">            
            <form id="loginform" class="form-vertical" action="index.php" method="post">
				<p>Enter username and password to continue.</p>
                <!--alert-->
              		
                <!--alert-->
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input name="<?php echo USERNAME; ?>" type="text" id="<?php echo USERNAME; ?>" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <input name="<?php echo PASSWORD; ?>" type="password" id="<?php echo PASSWORD; ?>" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <span class="pull-left"><input type="submit" class="btn btn-inverse" value="Login" name="btnlogin"/></span>
            </form>
        </div></p>
            </div>
            <div class="span3 pull-right">&nbsp;</div>
      </div>
       <!--sponsorship partnership
       <div class="row-fluid mardiv span12">
        	<marquee>sponsors link</marquee>
         </div>-->
   <?php require_once('adfooter.php');?>
</div>
</body>
</html>