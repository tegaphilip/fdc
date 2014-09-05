<?php
    $confo = new Conference();
    $conferences = $confo->getConferences();
?>
<link rel="stylesheet" href="../DataTables-1.9.4/media/css/jquery.dataTables.css" type="text/css" />
<script src="../DataTables-1.9.4/media/js/jquery.js"></script>
<script src="../DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
                            $(document).ready(function () {
                               //alert("javascrsdfdsfdsfsdipt");
                               $('#table_id').dataTable();
//                                $('#data-table').dataTable({
//                                    "sPaginationType": "full_numbers"
//                                });
                            });
                </script>
<div id="header">
					
		</div>
		<div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
                <li class="btn btn-inverse" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
                <li class="btn btn-inverse"><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Change Password</span></a></li>
                <li class="btn btn-inverse"><a title="" href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
            
		<div id="sidebar">
			<a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
			<ul>
				<li class="active"><a href="index.php"><i class="icon icon-home"></i> <span>Home</span></a></li>
				<li class="submenu">
					<a href="#"><i class="icon icon-th-list"></i> <span>Publications</span> <span class="label">+</span></a>
				    <ul>
						<li><a href="publication_books.php">Books</a></li>
                        <li><a href="publish_journal.php">Journals</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i class="icon icon-file"></i> <span>Manage Conferences</span> 
                                            <span class="label"><?php echo count($conferences); ?></span></a>
					<ul>
                    	<li><a href="manageconferences.php">View Conferences</a></li>
						<li><a href="createconference.php">Create Conference</a></li>
                                                <li><a href="participants.php">Participants</a></li>
                                                <li><a href="addparticipant.php">Registration for Conference</a></li>
					</ul>
		    </li>
				<li><a href="members.php"><i class="icon icon-pencil"></i> <span>Manage Members</span></a></li>
				
                <li>
					<a href="logs.php"><i class="icon icon-file"></i> <span>Logs</span></a>
<!--					<ul>
                    	<li><a href="#">Members List</a></li>
						<li><a href="#">Conference Register</a></li>
						<li><a href="#">Conference Payment</a></li>
						<li><a href="#">Conference details</a></li>
					</ul>-->
				</li>
                 <li class="submenu">
					<a href="#"><i class="icon icon-adjust"></i> <span>Setups</span> <span class="label">+</span></a>
					<ul>
<!--                    	<li><a href="#">States</a></li>-->
                        <li><a href="add_sponsor.php">View and Create Sponsors</a></li>
                        <li><a href="add_linkage.php">View and Create Linkages</a></li>
                        <li><a href="add_affiliation.php">View and Create Affiliations</a></li>
<!--						<li><a href="#">Countries</a></li>-->
					</ul>
				</li>
				<li>
					<a href="http://webmail.facultydevelopmentcentre.com/"><i class="icon icon-signal"></i> <span>Webmail</span></a>
				</li>
          <li class="submenu">
					<a href="#"><i class="icon icon-user"></i> <span>Profile Management</span> <span class="label">+</span></a>
					<ul>
						<li><a href="admin.php">Add Admin</a></li>
						<li><a href="updateprofile.php">Update Profile</a></li>
					</ul>
				</li>
				<li>
					<a href="logout.php"><i class="icon icon-inbox"></i> <span>Logout</span></a>
				</li>
			</ul>
		
		</div>