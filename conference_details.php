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
                <p><h1>Schedule</h1></p>
                
            <table width="100%" cellspacing="2" cellpadding="2" class="table table-striped">
                    <tr align='left'>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Program</th>
                    </tr>
                    
                    <?php
                        $i = 0;
                        foreach($activities as $act){
                    ?>
                    <tr>
                        <td><?php echo date("l jS  F, Y",$act[START_TIME]); ?></td>
                        <td><?php echo date("g:i a ",$act[START_TIME]); ?> to <?php echo date("g:i a ",$act[END_TIME]); ?> </td>
                        <td><?php echo $act[DAY_TITLE]; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td colspan="3">
                            <a href="register_conference.php?id=<?php echo $conference[CONFERENCE_CODE]; ?>"><button class="btn btn-primary btn-large"><strong>Register for Conference</strong></button></a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="3">
                            
                                For further enquiries contact:
                            <ul>
                                <li>
                                    <strong>Dr. Kola Babarinde</strong> (Teacher Education Department, University of Ibadan, Oyo State)
                                    <br>08033223932
                                    <br><a href="mailto:kbabarinde@gmail.com">kbabarinde@gmail.com</a>
                                    <br><strong>Chairman, LOC</strong>
                                </li>
                                <br>
                                <li>
                                    <strong>Dr. Chris Omoregie</strong> (Department of Adult Education, University of Ibadan, Oyo State)
                                    <br>08033685734
                                    <br><a href="mailto:chrisomoregie@yahoo.com">chrisomoregie@yahoo.com</a>
                                    <br><strong>Secretary</strong>
                                </li>
                                <br>
                                <li>
                                    <strong>Dare Olufowobi</strong> (Faculty of Education, Lagos State University, Ojo, Lagos)
                                    <br>08023844317
                                    <br><a href="mailto:Okikiola2001@yahoo.com">Okikiola2001@yahoo.com</a>
                                    <br><strong>Media and Publicity</strong>
                                </li>
                                
                            </ul>
                                
                           
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3"><h2>Abstracts & Papers</h2></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Abstracts of not more than 250 words should be sent through the conference website
                            from this  <a href="">link</a> or sent to 
                            <a href="mailto:chrisomoregie@yahoo.com">mailto:chrisomoregie@yahoo.com</a>
                            not later than 30th July 2013.
                            <br><br>
                            The full paper of not more than 15 pages of A4 sized paper double line spacing
                            shpuld be sent electronically on or before 30th August, 2013.
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3"><h2>Relaxation</h2></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Below are some of the hotels around the University of Ibadan
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3">
                            <table width="100%">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Room Type</th>
                                    <th>Rate per night</th>
                                    <th>Contact</th>
                                </tr>
                                <tr>
                                    <td valign="middle">1</td>
                                    <td>Shlata Guest House</td>
                                    <td>13 Kola Adewoyin str.,off Nasu road, U.I, Agbowo Ibadan</td>
                                    <td width="20%">
                                        <table>
                                            <tr><td>Extra double</td></tr>
                                            <tr><td>Double</td></tr>
                                            <tr><td>Standard</td></tr>
                                            <tr><td>Single</td></tr>
                                        </table>
                                    </td>
                                    <td width="15%">
                                        <table>
                                            <tr><td>₦3,200</td></tr>
                                            <tr><td>₦3,000</td></tr>
                                            <tr><td>₦2,800</td></tr>
                                            <tr><td>₦2,500</td></tr>
                                        </table>
                                    </td>
                                    <td>+2348033059643<br>+2347045653209</td>
                                    
                                </tr>
                                <tr>
                                    <td valign="middle">2</td>
                                    <td>Plaza Park Hotel (Nig)Ltd Ibadan</td>
                                    <td>96 U.I Bodija ExpressRoad</td>
                                    <td width="20%">
                                        <table>
                                            <tr><td>Suites</td></tr>
                                            <tr><td>Double room</td></tr>
                                            <tr><td>Single A</td></tr>
                                            <tr><td>Single B</td></tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr><td>₦9,000</td></tr>
                                            <tr><td>₦7,000</td></tr>
                                            <tr><td>₦6,000</td></tr>
                                            <tr><td>₦5,000</td></tr>
                                        </table>
                                    </td>
                                    <td>+2348055911050</td>
                                </tr>
                                <tr>
                                    <td valign="middle">3</td>
                                    <td>Midetel Hotel</td>
                                    <td>10, Omotara street, Agbowo U.I, Ibadan</td>
                                    <td width="20%">
                                        <table>
                                            <tr><td>Executive</td></tr>
                                            <tr><td>Superior</td></tr>
                                            <tr><td>Regular</td></tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr><td>₦9,000</td></tr>
                                            <tr><td>₦6,500</td></tr>
                                            <tr><td>₦5,500</td></tr>
                                        </table>
                                    </td>
                                    <td>+2348121443444<br>+2347043267430</td>
                                </tr>
                                <tr>
                                    <td valign="middle">4</td>
                                    <td>Samba Morayo Hotels</td>
                                    <td>Agbowo U.I, Ibadan</td>
                                    <td width="20%">
                                        <table>
                                            <tr><td>Suit</td></tr>
                                            <tr><td>Superior</td></tr>
                                            <tr><td>Regular</td></tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr><td>₦3,000</td></tr>
                                            <tr><td>₦2,500</td></tr>
                                            <tr><td>₦2,000</td></tr>
                                        </table>
                                    </td>
                                    <td>+2348039291549</td>
                                </tr>
                                <tr>
                                    <td valign="middle">5</td>
                                    <td>Ayotoz Hotel</td>
                                    <td>3, Adegbite str., opposite Kenny Gee Plaza, U.I gate, Ibadan</td>
                                    <td width="20%">
                                        <table>
                                            <tr><td>Superior</td></tr>
                                            <tr><td>Regular</td></tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr><td>₦3,500</td></tr>
                                            <tr><td>₦3,000</td></tr>
                                        </table>
                                    </td>
                                    <td>+2348176223207</td>
                                </tr>
                                <tr>
                                    <td valign="middle">6</td>
                                    <td>Primas Guest House</td>
                                    <td>Akintoba Street, Agbowo, Ibadan</td>
                                    <td width="20%">
                                        <table>
                                            <tr><td>Superior</td></tr>
                                            <tr><td>Suite</td></tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr><td>₦3,500</td></tr>
                                            <tr><td>₦2,500</td></tr>
                                        </table>
                                    </td>
                                    <td>+2348076820921</td>
                                </tr>
                                <tr>
                                    <td valign="middle">7</td>
                                    <td>Tamar Guest House</td>
                                    <td>2, Aseda close, beside JKIC, Agbowo, U.I, Ibadan</td>
                                    <td width="20%">
                                        <table>
                                            <tr><td>All rooms</td></tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr><td>₦2,000</td></tr>
                                        </table>
                                    </td>
                                    <td>+2348031163857</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                        
                </table>
                
                
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