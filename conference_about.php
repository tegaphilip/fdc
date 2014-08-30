<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Constants.php';
require_once 'classes/Conference.php';
require_once 'classes/Utilities.php';
$db = new Database();
new Constants();
$conf = new Conference();   
$util = new Utilities();
$conference = $conf->getConference($_GET[ID]);
if(count($conference)==0){
    $_SESSION[ERROR_TRANSFERER] = "The page you are attempting to visit was not found!<br>
        Click <a href='index.php'>here</a> to go to our home page";
    header("location:error.php");
}
$activities = $conf->getActivities($conference[CONFERENCE_ID]);
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
      <!--SLIDER HERE--><!--SLIDER-->
      
            <div class="span8">
             	<h1 class="breadcrumb"><center><?php echo strtoupper($conference[CONFERENCE_TITLE]); ?></center></h1>
                <table border="0" width="100%" cellspacing='5' cellpadding='5'>
                    
                    <tr>
                        <td colspan="2">
                            <ul class="thumbnails pull-right">
                    <?php 
                        $src = !empty($conference[LOGO])? $conference[LOGO] :"def_logo.jpg";
                    ?>
                    <img src="images/uploads/confs/<?php echo $src; ?>">
               </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><h3>THEME:</h3></td><td><?php echo $conference[CONFERENCE_TITLE]; ?></td>
                    </tr>
                    <tr>
                        <td><h3>DATE:</h3></td>
                        <td><?php echo $util->getFriendlyDate($conference[START_DATE]); ?> to
                        <?php echo $util->getFriendlyDate($conference[END_DATE]); ?></td>
                    </tr>
                    <tr>
                        <td><h3>TIME:</h3></td><td> <?php echo $conference[TIME]; ?></td>
                    </tr>
<!--                    <tr>
                        <td><h3>CHAIRMAN:</h3></td><td><?php echo $conference[CONFERENCE_CHAIRMAN]." (".$conference[CHAIRMAN_POSITION].")"; ?></td>
                    </tr>-->
                    <tr>
                        <td><h3>VENUE:</h3></td><td><?php echo $conference[VENUE]; ?></td>
                    </tr>
                    
                </table>
                <p><h1>About The Conference</h1></p>
                
            <p>
                Discourses on government policies,
programmes and activities have been
leveraging on the fact that education is an
instrument for development without
sufficient exposition on how education
through its philosophy can be used for
social transformation.
There have been continuing efforts by
world organisations like the United
Nations in globalising morality. The
national, state and local governments in
Nigeria have also made attempts to
promote justice and peace. Despite these
efforts, violence, conflict, war, abortion,
same sex marriages, capital punishment,
cloning, euthanasia, poverty, national
debts and environmental problems
confront societies in varied degrees.
More than ever before, human societies
are in search of deeper meanings into the
day to day experiences of social problems.
Education for social ethics creates the
platform for probing social issues on the
endemic problems of our world and the
Nigerian society in particular.
This year’s FDC conference with the
theme Philosophy of Education for Social
Ethics intends to engage all stakeholders
in education on the relationship which
exists between education as well as its
philosophy and social ethics.
            </p>
                
           <p><h1>Sub - Themes</h1></p>
            <p>
            <ul>
                <li>Education for Social Transformation and Security.</li>
                <li>Education, Social Ethics and Policy
Making.</li>
                <li>Education for Peaceful Co – existence.</li>
                <li>Counselling for Social Ethics.</li>
                <li>Social Ethics and Medical Practices.</li>
                <li>Teacher Education and Social Ethics.</li>
                <li>Adult Education and Social Ethics.</li>
                <li>Early Childhood Care and Social Ethics.</li>
                <li>Administration, Management and Social Ethics.</li>
                <li>The New Media and Social Ethics.</li>
                <li>Religious Institutions and Social Ethics.</li>
                <li>Philosophies and Aims of Education.</li>
                <li>Creativity and Innovations in Education.</li>
                <li>Quality Assurance in Educational Practices.</li>
                <li>Environmental Education and Social Ethics.</li>
                <li>Indigenous Values and Social Ethics.</li>
                <li>Social Ethics and Women Education.</li>
                <li>Science Education and Social Ethics.</li>
            </ul>
            </p>
            
            <p>
                <a href="register_conference.php?id=<?php echo $conference[CONFERENCE_CODE]; ?>"><button class="btn btn-primary btn-large"><strong>Register for Conference</strong></button></a>
                            <a href="conference_details.php?id=<?php echo $conference[CONFERENCE_CODE]; ?>"><button class="btn btn-primary btn-large"><strong>View More Information</strong></button></a>
            </p>
            </div>
            <div class="span4 pull-right">
            	<?php require_once 'login_newaccount.php';?>
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