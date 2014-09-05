<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';

$db = new Database();
new Constants();
$member = new Member();
$member->validateLogin();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>::FDC::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link id="switch_style" href="bootstrap/css/united/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/jquery.rating.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
	<?php require_once('header.php');?>
      <div class="row">
      
            <div class="span12">
             	<h4 class="breadcrumb">FDC CONSTITUTION</h4>
                <p>
                
                <table width="100%" border="0" cellspacing="5" cellpadding="5" align="center" bgcolor="#FFFFFF">
            <tr>
            <td width="30%" align="left" valign="middle" bgcolor="#FFFFFF" class="nicn">&nbsp;</td>
            <td width="70%" valign="top" bgcolor="#FFFFFF" align="left"><a href="uploadedfiles/constitution.pdf" title="Click here to download" target="_blank"><img src="images/icons/pdf_icon.jpg" alt="pdficon" width="53" height="53" border="0" /></a></td>
        </tr>
            <td align="left" valign="top" bgcolor="#FFFFFF" colspan="2">
             
                  	<div id="embeddedpdf" align="center">
                    <!-- Embed PDF File -->
                    <OBJECT data="uploadedfiles/constitution.pdf" TYPE="application/x-pdf" TITLE="Constitution" WIDTH=940 HEIGHT=700>
                      <embed src="uploadedfiles/constitution.pdf" width="940" height="700"></embed>
                    </object>
                 </div>    
                 
            </td>
        </tr>
    </table>
    </p>
</div>
           
      </div>
      <!--sponsorship partnership
        <div class="row-fluid mardiv span12">
        	<marquee>sponsors link</marquee>
        </div>-->
    <?php require_once('footer.php');?>
</div>
</body>
</html>