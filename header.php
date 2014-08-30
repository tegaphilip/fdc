<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Utilities.php';
require_once 'classes/Constants.php';
require_once 'classes/Member.php';
require_once 'classes/Conference.php';

$db = new Database();
new Constants();
$member = new Member();
$confo = new Conference();

$recent = $confo->getMostRecentConference();

?>
<div class="row"><!-- start header -->
        <div id="banner">
        	<div class="span4"></div>
			<div class="span8 toplink">
				<div class="row">
					<div class="links pull-right">
						<a href="index.php">Home</a> |
                        <a href="history.php" title="About FDC">About</a> |
						<a href="contact.php" title="Contact @FD">Contact</a>
<!--                        --><?php
//							if(isset($_SESSION[MEMBER_ID])){
//						?>
<!--                        	|<a href="mem_profileupdate.php" title="">Profile</a>-->
<!--                        	|<a href="logout.php" title="">Logout</a>-->
<!--                        --><?php
//						}
//						?>
					</div>
				</div>
		  </div>
            
         </div>
         <div class="clearfix separate"></div>
		</div><!-- end header -->
		
		<div class="row"><!-- start nav -->
			<div class="span12">
			  <div class="navbar">
					<div class="navbar-inner">
					  <div class="container" style="width: auto;">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</a>
						<div class="nav-collapse">
						  <ul class="nav">
                          	  <li><a href="index.php">Home</a></li>
                              	<li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">About FDC<b class="caret"></b></a>
							  <ul class="dropdown-menu">
                                <li><a href="#" title="FDC Vision">Vision</a></li>
                                <li><a href="#" title="FDC Mission Statement">Mission Statement</a></li>
								<li class="divider"></li>
							  </ul>
							</li>
							<li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Publications<b class="caret"></b></a>
							  <ul class="dropdown-menu">
								<li><a href="#">Journal</a></li>
								<li><a href="#">Books</a></li>
							  </ul>
							</li>
							 <li><a href="#">FDC Gallery</a></li>
                             <li><a href="#">Contact FDC</a></li>
						  </ul>
						  <ul class="nav pull-right">
						   <li class="divider-vertical"></li>
							<form class="navbar-search" action="#">
								<input type="text" class="search-query span2" placeholder="Search">
								<button class="btn btn-primary btn-small search_btn" type="submit">Go</button>
							</form>
							
						  </ul>
						</div><!-- /.nav-collapse -->
					  </div>
					</div><!-- /navbar-inner -->
				</div><!-- /navbar -->
			</div>
		</div><!-- end nav -->