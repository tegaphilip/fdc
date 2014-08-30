<?php
    require_once 'classes/Constants.php';
    new Constants();
    session_start();
    //echo $_SESSION[MEMBER_ID]."sdsd";
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
             	<h4 class="breadcrumb">PFDCHISTORY</h4>
                <p>At the inception of the Teacher Education programmes in the 1960s in the colleges of Education and the faculties of Education in Nigerian Universities, the teaching of the Philosophy of Education and other courses in the foundation of was all comers affair. Everyone who knew about Philosophy, History, Sociology or Comparative Education taught these courses. It was the concern for the bastardization of the foundations (now Educational Studies) that led a group of lecturers at the University of Benin, Port-Harcourt, Ife, Ibadan and Lagos to come together on Thursday, 13th November, 1980 by 10:30 a.m. at the University of Benin to rub minds. Under the chairmanship of Dr. J. Nesin Omatseye (PEFDC First President) the group including Drs. J.D. Okoh, J.M. Kosemani, Obidi, Aladejana and others agreed to start a professional association of educational philosophers and also an umbrella organization for all teachers in the foundations in Universities and Colleges of Education.
                </p>
                <p>
Subsequent annual meetings at UNIPORT, UI, UNILAG and UNN attracted other founding professors as Otonti Nduka (Uniport), Jones Akinpelu (UI), Msgr. Prof. F.G. Okafor (UNN), Adewole (UNIJOS) who strengthened the association as leaders. Two years into its founding, the association, now christened "The Philosophy of Education Association of Nigeria (PEAFDCnow decided to start the Nigerian Jpurnal of Educational Philosophy (NJEP). With donations and annual dues from a few members at the time, it was a feeble attempt to provide a forum for sharing ideas formulating educational theories and policies for teacher education students in Nigeria. Apart from NJEP, PEANFDC since initiated other publications, thanks to the new generation of educational philosophers whose activities have sustained and strengthened PEAN FDCNJEP. As educational philosophers we owe it to our profession to protect the integrity of our calling so that subsequent generations will not be disappointed. The number of books and other publications coming out of the PEAN family is something to be proud of.
</p>

                <ul class="thumbnails pull-right">
                    <img src="images/socrates.JPG" alt="Socrates" title="Socrates">
               </ul>
                <ul class="thumbnails pull-right">
                    <img src="images/plato.jpg" alt="Plato" title="Plato">
               </ul>
               <ul class="thumbnails pull-right">
                   <img src="images/aristotle.jpg" alt="Plato" title="Aristotle">
               </ul>
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