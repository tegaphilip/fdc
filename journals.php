<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Constants.php';
require_once 'classes/Publications.php';
require_once 'classes/Utilities.php';
require_once 'classes/ps_pagination.php';

$db = new Database();
new Constants();
$util = new Utilities();

$query = "SELECT * FROM journals";
if(isset($_GET['year'])){
    $query .= " WHERE journal_year = '".$_GET['year']."'";
}
$query .= " ORDER BY journal_date DESC";

$pager = new PS_Pagination($db->getConnection(),$query,10,3);
$rs = $pager->paginate();

//print_r($books);
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
    <style>
	 .right-sidebar {
	width: 140px;
	margin-left: 20px;
	right: 20px;
	/*top: 20px;*/
	position: relative;
}
    .right-sidebar .wrapper {
	background: #e6e6e6;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	height: auto;      /*  INDEX Page Elements Start  */
	padding: 5px;      /*  INDEX Page Elements Ends Here */
      /*  GRAPHS Page Elements Starts Here */
      /*  GRAPHS Page Elements Ends Here */
      /*  FORMS Page Elements Starts Here */
      /*  FORMS Page Elements Ends Here */
      /*  ICONS Page Elements Starts Here */
      /*  Push Buttons  */
      /*  Doc icons  */
      /*  ICONS page elements end here */ }
      .right-sidebar .wrapper .featured-articles-container {
	background: #f7f7f7;
	padding-right: 10px;
	padding-bottom: 10px;
	padding-left: 10px;
}
         .right-sidebar .wrapper .featured-articles-container .heading, .dashboard-wrapper .right-sidebar .wrapper .featured-articles-container .heading-blue {
          margin-top: 0;
          color: #ed6d49;
          padding-bottom: 8px;
          border-bottom: 1px dotted #d9d9d9; }
        .right-sidebar .wrapper .featured-articles-container .heading-blue {
          color: #0daed3; }
        .right-sidebar .wrapper .featured-articles-container .articles a {
          position: relative;
          border-bottom: 1px dotted #d9d9d9;
          color: #0d0d0d;
          display: block;
          font-size: 12px;
          font-weight: 500;
          line-height: 30px;
          padding-left: 20px;
          margin-bottom: 1px; }
           .right-sidebar .wrapper .featured-articles-container .articles a:hover {
            color: #737373; }
        .right-sidebar .wrapper .featured-articles-container .articles a .label-bullet, .dashboard-wrapper .right-sidebar .wrapper .featured-articles-container .articles a .label-bullet-blue {
            position: absolute;
            left: 1px;
            top: 10px;
            width: 0;
            height: 0;
            border-top: 9px solid #ef8060;
            border-left: 9px solid transparent; }
          .right-sidebar .wrapper .featured-articles-container .articles a .label-bullet-blue {
            border-top: 9px solid #0ec2eb; }
           .right-sidebar .wrapper .featured-articles-container .articles a .date {
            font-size: 10px;
            padding-left: 2px;
            color: #b3b3b3;
            font-weight: normal; }
       .right-sidebar .wrapper .featured-articles-container .articles:hover {
          opacity: 1;
          cursor: default; }
         .right-sidebar .wrapper .featured-articles-container .articles .phone {
          text-align: right;
          font-size: 12px;
          padding-top: 5px; }
      .right-sidebar .wrapper .stats li {
        padding: 10px;
        background: #f7f7f7;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -webkit-transition: All 0.5s ease;
        -moz-transition: All 0.5s ease;
        -ms-transition: All 0.5s ease;
        -o-transition: All 0.5s ease;
        transition: All 0.5s ease;
        border: 1px solid #d9d9d9;
        height: 42px;
        margin-bottom: 4px; }
        .right-sidebar .wrapper .stats li:last-child {
          margin-bottom: 0px; }
        .right-sidebar .wrapper .stats li:hover {
          opacity: 0.7;
          cursor: pointer; }
        .right-sidebar .wrapper .stats li .left {
          border-right: 1px solid #e6e6e6;
          float: left;
          display: inline-block;
          text-align: left;
          width: 120px;
          margin-right: 10px; }
         .right-sidebar .wrapper .stats li .left h4 {
            margin-top: 0;
            margin-bottom: 6px;
            color: #4d4d4d; }
         .right-sidebar .wrapper .stats li .left p {
            font-size: 11px;
            color: #ed6d49;
            text-transform: uppercase;
            margin-bottom: 0; }
        .right-sidebar .wrapper .stats li:nth-child(2) p {
          color: #74b749; }

         .right-sidebar .wrapper .stats li:nth-child(3) p {
          color: #ffb400; }
        .right-sidebar .wrapper .stats li:nth-child(4) p {
          color: #0daed3; }
        .right-sidebar .wrapper .stats li:nth-child(5) p {
          color: #f63131; }
        .right-sidebar .wrapper .stats li .chart {
          width: 70px;
          margin-top: 10px;
          margin-left: 5px;
          float: left; }
       .right-sidebar .wrapper .month-income li {
        padding: 5px;
        background: #f7f7f7;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -webkit-transition: All 0.5s ease;
        -moz-transition: All 0.5s ease;
        -ms-transition: All 0.5s ease;
        -o-transition: All 0.5s ease;
        transition: All 0.5s ease;
        border: 1px solid #d9d9d9;
        height: 38px;
        margin-bottom: 4px; }
        .right-sidebar .wrapper .month-income li:last-child {
          margin-bottom: 0px; }
        .right-sidebar .wrapper .month-income li:hover {
          opacity: 0.7;
          cursor: pointer; }
         .right-sidebar .wrapper .month-income li .icon-block {
          width: 38px;
          height: 38px;
          line-height: 42px;
          float: left;
          margin-top: 0;
          color: white;
          text-align: center;
          vertical-align: middle;
          -webkit-border-radius: 2px;
          -moz-border-radius: 2px;
          border-radius: 2px; }
        .right-sidebar .wrapper .month-income li h5 {
          margin: 0 0 0 45px;
          padding: 0;
          color: gray; }
           .right-sidebar .wrapper .month-income li h5 small {
            font-size: 11px; }
         .right-sidebar .wrapper .month-income li p {
          font-size: 11px;
          margin-bottom: 0;
          margin-left: 45px;
          color: #b3b3b3; }
        .right-sidebar .wrapper .month-income li .yellow-block {
          background: #ffb400; }
       .right-sidebar .wrapper .month-income li .orange-block {
          background: #ed6d49; }
         .right-sidebar .wrapper .month-income li .green-block {
          background: #74b749; }
         .right-sidebar .wrapper .month-income li .blue-block {
          background: #0daed3; }
        .right-sidebar .wrapper .month-income li .red-block {
          background: #f63131; }

		/** main*/
		
		 .dashboard-wrapper .left-sidebar {
	height: auto;
     }
    .dashboard-wrapper .left-sidebar .widget {
      background: #fafafa;
      border: 1px solid #e0dede;
      clear: both;
      margin-top: 0px;
      margin-bottom: 30px;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px; }
      .dashboard-wrapper .left-sidebar .widget .widget-header {
        background-color: #eaeaea;
        /* Fallback Color */
        background-image: -webkit-gradient(linear, left top, left bottom, from(#fdfdfd), to(#eaeaea));
        /* Saf4+, Chrome */
        background-image: -webkit-linear-gradient(top, #fdfdfd, #eaeaea);
        /* Chrome 10+, Saf5.1+, iOS 5+ */
        background-image: -moz-linear-gradient(top, #fdfdfd, #eaeaea);
        /* FF3.6 */
        background-image: -ms-linear-gradient(top, #fdfdfd, #eaeaea);
        /* IE10 */
        background-image: -o-linear-gradient(top, #fdfdfd, #eaeaea);
        /* Opera 11.10+ */
        background-image: linear-gradient(top, #fdfdfd, #eaeaea);
        -webkit-border-radius: 2px 2px 0 0;
        -moz-border-radius: 2px 2px 0 0;
        border-radius: 2px 2px 0 0;
        border-bottom: 1px solid #e0dede;
        height: 24px;
        line-height: 24px;
        padding: 10px; }
.container .row .span6 .thumbnails .dashboard-wrapper {
	width: 460px;
	float: right;
}
        .dashboard-wrapper .left-sidebar .widget .widget-header .title {
          color: #333333;
          float: left;
          font-weight: bold;
          font-size: 16px; }
          .dashboard-wrapper .left-sidebar .widget .widget-header .title .attribution, .dashboard-wrapper .left-sidebar .widget .widget-header .title .mini-title {
            font-size: 11px;
            padding-left: 4px;
            color: #b3b3b3;
            font-weight: normal; }
        .dashboard-wrapper .left-sidebar .widget .widget-header span.tools {
          padding: 0;
          float: right;
          margin: 0; }
          .dashboard-wrapper .left-sidebar .widget .widget-header span.tools > a {
            display: inline-block;
            margin-right: 5px;
            color: #666666;
            margin-top: 3px; }
            .dashboard-wrapper .left-sidebar .widget .widget-header span.tools > a:hover {
              text-decoration: none;
              opacity: .6; }
      .dashboard-wrapper .left-sidebar .widget .widget-body {
        padding: 10px;
        border-bottom: 1px solid #b3b3b3;
        -webkit-border-radius: 0 0 2px 2px;
        -moz-border-radius: 0 0 2px 2px;
        border-radius: 0 0 2px 2px;
        /*  INDEX Page Elements Start  */
        /*  INDEX Page Elements End  */
        /*  GRAPHS Page Elements Start  */
        /*  GRAPHS Page Elements End  */
        /*  ICONS Page Elements Start  */
        /*  ICONS Page Elements End  */
        /*  FORMS Page Elements Start  */
        /*  FORMS Page Elements End  */
        /*  TABLES Page Elements Start  */
        /*  TABLES Page Elements End  */ }
        .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container {
          width: 100%; }
          .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list {
            min-height: 180px; }
            .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list li {
              background: whitesmoke;
              border-bottom: 1px dotted #cccccc;
              line-height: 34px; }
              .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list li:last-child {
                border-bottom: 0; }
              .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list li input[type="checkbox"] {
                margin: 0 2px 0 10px; }
                .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list li input[type="checkbox"]:checked + label {
                  text-decoration: line-through;
                  color: #999999; }
              .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list li label {
                display: inline-block;
                cursor: pointer;
                font-size: 12px; }
                .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list li label .date {
                  font-size: 10px;
                  color: #b3b3b3;
                  padding-left: 5px; }
              .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list li:hover {
                background: #fafafa; }
            .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list .new {
              border-left: 3px solid #ed6d49;
              margin: 1px 0; }
            .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list .completed {
              border-left: 3px solid #74b749;
              margin: 1px 0; }
            .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .todo-list .process {
              border-left: 3px solid #ffb400;
              margin: 1px 0; }
          .dashboard-wrapper .left-sidebar .widget .widget-body .todo-container .input-append {
            margin-top: 5px;
            margin-bottom: 0;
            width: 90%; }
        .dashboard-wrapper .left-sidebar .widget .widget-body .message-container .message {
          position: relative;
          margin-bottom: 10px;
          min-height: 84px;
          padding: 5px;
          background: white;
          border: 1px solid #d9d9d9;
          -webkit-border-radius: 2px;
          -moz-border-radius: 2px;
          border-radius: 2px;
          overflow: hidden; }
        .dashboard-wrapper .left-sidebar .widget .widget-body .message-container .img-container {
          width: 10%;
          position: absolute;
          padding: 2px; }
          .dashboard-wrapper .left-sidebar .widget .widget-body .message-container .img-container img {
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            max-height: 80px;
            width: 100%; }
        .dashboard-wrapper .left-sidebar .widget .widget-body .message-container article {
          width: 85%;
          position: absolute;
          left: 13%;
          right: 2%;
          top: 0px;
          padding: 5px 0;
          border-bottom: 1px solid #e6e6e6; }
          .dashboard-wrapper .left-sidebar .widget .widget-body .message-container article a {
            color: #ed6d49; }
        .dashboard-wrapper .left-sidebar .widget .widget-body .message-container .icons-nav {
          width: 85%;
          position: absolute;
          left: 13%;
          top: 60px; }
          .dashboard-wrapper .left-sidebar .widget .widget-body .message-container .icons-nav ul li {
            float: right;
            display: inline-block; }
            .dashboard-wrapper .left-sidebar .widget .widget-body .message-container .icons-nav ul li [data-icon]:before {
              margin: 0 4px;
              line-height: 24px;
              font-size: 12px;
              color: #ed6d49; }
          .dashboard-wrapper .left-sidebar .widget .widget-body .message-container .icons-nav li.time {
            float: left;
            color: #bfbfbf; }
        .dashboard-wrapper .left-sidebar .widget .widget-body .easy-pie-charts-container .pie-chart {
          margin-right: 20px;
          float: left; }
          .dashboard-wrapper .left-sidebar .widget .widget-body .easy-pie-charts-container .pie-chart .name {
            text-align: center;
            padding-top: 10px; }
        .dashboard-wrapper .left-sidebar .widget .widget-body .icomoon-icons-container li {
          background-color: #e6e6e6;
          /* Fallback Color */
          background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#e6e6e6));
          /* Saf4+, Chrome */
          background-image: -webkit-linear-gradient(top, #f2f2f2, #e6e6e6);
          /* Chrome 10+, Saf5.1+, iOS 5+ */
          background-image: -moz-linear-gradient(top, #f2f2f2, #e6e6e6);
          /* FF3.6 */
          background-image: -ms-linear-gradient(top, #f2f2f2, #e6e6e6);
          /* IE10 */
          background-image: -o-linear-gradient(top, #f2f2f2, #e6e6e6);
          /* Opera 11.10+ */
          background-image: linear-gradient(top, #f2f2f2, #e6e6e6);
          border: 1px solid #e0e0e0;
          color: #666666;
          -webkit-border-radius: 2px;
          -moz-border-radius: 2px;
          border-radius: 2px;
          display: inline-block;
          float: left;
          margin-right: 5px;
          margin-bottom: 5px;
          font-size: 16px;
          text-align: center;
          vertical-align: middle;
          width: 32px;
          height: 32px;
          line-height: 32px; }
          .dashboard-wrapper .left-sidebar .widget .widget-body .icomoon-icons-container li:hover {
            background: white;
            cursor: pointer; }
        .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example {
          /* Sorting */ }
          .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_length {
            float: left; }
            .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_length select {
              width: 80px;
              height: 30px;
              margin-bottom: 0; }
          .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_filter {
            float: right; }
            .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_filter input {
              width: 160px;
              margin-bottom: 0; }
          .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_info {
            float: left;
            margin-bottom: 5px; }
          .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate {
            margin: 5px 0;
            float: right; }
            .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .first, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .previous, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .next, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .paginate_active, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .last, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .paginate_button {
              background-color: #e6e6e6;
              /* Fallback Color */
              background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#e6e6e6));
              /* Saf4+, Chrome */
              background-image: -webkit-linear-gradient(top, #f2f2f2, #e6e6e6);
              /* Chrome 10+, Saf5.1+, iOS 5+ */
              background-image: -moz-linear-gradient(top, #f2f2f2, #e6e6e6);
              /* FF3.6 */
              background-image: -ms-linear-gradient(top, #f2f2f2, #e6e6e6);
              /* IE10 */
              background-image: -o-linear-gradient(top, #f2f2f2, #e6e6e6);
              /* Opera 11.10+ */
              background-image: linear-gradient(top, #f2f2f2, #e6e6e6);
              border-left: 1px solid #d9d9d9;
              border-top: 1px solid #d9d9d9;
              border-bottom: 1px solid #d9d9d9;
              padding: 7px 10px; }
              .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .first:hover, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .previous:hover, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .next:hover, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .paginate_active:hover, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .last:hover, .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .paginate_button:hover {
                background: #f9f9f9;
                cursor: pointer; }
            .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .last {
              border-right: 1px solid #d9d9d9; }
            .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTables_paginate .paginate_active {
              background: #f9f9f9; }
          .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTable .sorting {
            cursor: pointer;
            background: url(../img/sorting.png) no-repeat center right; }
          .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTable .sorting_asc {
            cursor: pointer;
            background: url(../img/sorting_asc.png) no-repeat center right; }
          .dashboard-wrapper .left-sidebar .widget .widget-body #dt_example .dataTable .sorting_desc {
            cursor: pointer;
            background: url(../img/sorting_desc.png) no-repeat center right; }
  
		
	</style>
    
  </head>
  <body>
    <div class="container">
	<?php require_once('header.php');?>
<div class="row">
		
    <div class="span2">
   	  <h4 class="breadcrumb">QUICK LINKS</h4>
        <!--begin side bar-->
        <div class="right-sidebar">
          <div class="wrapper">
            <div id="scrollbar">
              <div class="scrollbar">
                <div class="track">
                  <div class="thumb">
                    <div class="end">
                    </div>
                  </div>
                </div>
              </div>
              <div class="viewport">
                <div class="overview">
                  <div class="featured-articles-container">
                    <div class="articles">
                        <a href="journals.php">
                                <span class="label-bullet">
                                    &nbsp;
                                </span>
                        All
                      </a>
                        <?php
                            $now = date("Y",time());
                            for($i=$now-10;$i<=$now;$i++){
                        ?>
                            <a href="journals.php?year=<?php echo $i; ?>">
                                <span class="label-bullet">
                            &nbsp;
                            </span>
                        <?php echo $i; ?>
                      </a>
                        <?php
                            }
                        ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr class="hr-stylish-1">
      </div>
      <!--end side bar-->
      </div>
        
        
<div class="span6">
            <h4 class="breadcrumb">PUBLICATIONS (JOURNALS)</h4>
            <p>
      <ul class="thumbnails">
                 <div class="dashboard-wrapper">
          <div class="left-sidebar">
            <div class="row-fluid">
              
                <div class="widget">
                  <div class="widget-body">
                    <?php
                             
                        $i = 1;
                       while($bk = $pager->fetchArray($rs)) {
                        ?>
                      <blockquote>
                      <span class="title">
                        <?php echo $i ?>
                      </span>
                      <p>
                        <?php echo $bk[JOURNAL_TITLE]; ?>
                      </p>
                       <small>
                        <?php echo $bk[JOURNAL_AUTHORS]; ?><br/>
                        <cite><?php echo date("F, Y",$bk[JOURNAL_DATE]); ?></cite>
                       </small>
                      <?php if(!empty($bk[JOURNAL_COVER])){ ?>
                      <span>
                          <a title="View Cover" target="_blank" href="uploadedfiles/journals/<?php echo $bk[JOURNAL_COVER]; ?>">
                              <img src="images/pdf.png" />
                          </a>
                      </span>
                      <?php }?>
                    </blockquote>
                      
                      <?php echo "<hr/>";$i++; } if($pager->countRows()>10)echo $pager->renderFullNav();?>
                      <?php if($pager->countRows()==0) echo $util->displayWarningMessage("No journals found");?>
                  </div>
                </div>
     
            </div>
          </div>
  </div>
             </ul>
                        
               		
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