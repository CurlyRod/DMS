
	<?php  include('db_connection.php');
				$sql = "SELECT firstname,lastname FROM tbl_users  where id =".$_SESSION['id'];
				$result = $conn->query($sql);  
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
					$names =  $row["firstname"].' '.$row["lastname"]; 
					
					}
				}
				?> 
	<style>  
	.img-size{ 
		height:27px;width:27px;margin-right:10px;
	}.logo{ 
		height:90px; width: 200px;
	}
	</style>

	<nav id="sidebar" class="sidebar js-sidebar" >
				<div class="sidebar-content js-simplebar ">
					<a class="sidebar-brand" href="facultydashboard.php?page=facultyhome" >
			<span class="align-middle"><img src="./dashboard/images/sampless.png" class="logo" > </span>
			</a> 
		

					<ul class="sidebar-nav">
						<li class="sidebar-header">
							Pages
						</li>

						<li class="sidebar-item  ">
							<a class="sidebar-link" href="facultydashboard.php?page=facultyhome"> 
						<span class="align-middle"><img src="./dashboard/images/visualization.png" class="img-size"alt="" >
							Dashboard</span>
							</a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=facultyfiles">
							<span class="align-middle"><img src="./dashboard/images/documents.png" class="img-size"alt="" >
						Files</span>
						</a>
						</li>

						
	
						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=recent">
							<span class="align-middle"><img src="./dashboard/images/clock.png" class="img-size"alt="" >
						Recent</span> </a>
						</li>
				

						

					<li class="sidebar-item">
							
						<li class="sidebar-header">
						Manage Shared Files
						</li>
						
						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=facultylinkfolder">
							<span class="align-middle"><img src="./dashboard/images/Linkfolder.png"  class="img-size"alt="" >
						Link Folder</span> </a>
						</li> 
						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=facultysharefiles">
							<span class="align-middle"><img src="./dashboard/images/links.png"  class="img-size"alt="" >
						Link Files</span> </a>
						</li> 
						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=facultysharefile">
							<span class="align-middle"><img src="./dashboard/images/review.png"  class="img-size"alt="" >
						Received File</span> </a>
						</li> 

						</li> 
						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=facultymanagefile">
							<span class="align-middle"><img src="./dashboard/images/shared.png" class="img-size"alt="" >
						Received Folder</span> </a>
						</li> 
						
						 
						<li class="sidebar-header">
							Collaborative
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=facultycollab">
							<span class="align-middle"><img src="./dashboard/images/team-work.png"  class="img-size"alt="" >
						Workstation</span> </a>
						</li> 
						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=facultycollabreceivefolder">
							<span class="align-middle"><img src="./dashboard/images/teamwork1.png" class="img-size"alt="" >
						Teams</span> </a>
						</li> 
				
						<li class="sidebar-header">
							Archive
						</li>

						<!-- <li class="sidebar-item">
							<a class="sidebar-link" href="admindashboard.php?page=archivemodule/archiveuser">
				<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Account</span>
				</a>
						</li> -->


						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=archivemodule/userarchivefile">
							<span class="align-middle"><img src="./dashboard/images/redo.png" class="img-size"alt="" >
						File</span> </a>
						</li>

						<li class="sidebar-item">
							<a class="sidebar-link" href="facultydashboard.php?page=userarchivefolder">
							<span class="align-middle"><img src="./dashboard/images/backupfolder.png" class="img-size"alt="" >
						Folder</span> </a>
						</li>  

						

						
				
				
				
				
				
				
						<li class="sidebar-header " style=" margin-left:30px;">
							Alloted Storage 

						</li> 
						<li class="sidebar-item  ">
							<a class="sidebar-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop">  
						<span class="align-middle" ><img src="./dashboard/images/database.png" style="height:35px;margin-left:45px;" class="align-middle"alt="" >
							

							<div class="align-middle" id="allotedSize" style="
										margin-left: 12px;  
										margin-top: 5px; 
										font-size:11px;  
										color:#ffc107;"> 
									
									</div>  
									
									
											

					</span>
							</a>
						</li>
					</ul>

					
				</div>
			
			</nav>  
			<div class="main">
				<nav class="navbar navbar-expand navbar-light navbar-bg">
					<a class="sidebar-toggle js-sidebar-toggle">
			<i class="hamburger align-self-center"></i>
			</a> 

			<script>  
	 function formatBytes(bytes,decimals) {
    if(bytes == 0) return '0 Bytes';
    var k = 1024,
        dm = decimals || 2,
        sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
 }

	var fetchData = function() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "allotedsize.php", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = jQuery.parseJSON(xhr.responseText);
      // Process response data here 
	  console.log(formatBytes(response.data));  
	  var maxStorage =  formatBytes(32212254720 ) ; 
	  var totalUserStorage = formatBytes(0+response.data); 
	 
	  var defaultStorage = formatBytes(0);
		
	  document.getElementById("allotedSize").innerHTML = totalUserStorage +" used out of "+ maxStorage;
     
	}
  };
  xhr.send();
};

setInterval(fetchData, 2000); 
	</script>

					<div class="navbar-collapse collapse">
						<ul class="navbar-nav navbar-align">
							<li class="nav-item dropdown">
								<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
									<div class="position-relative ">
										<i class="align-middle d-none" data-feather="bell"></i>
										<span class="indicator d-none">4</span>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0 d-none" aria-labelledby="alertsDropdown">
									<div class="dropdown-menu-header">
										4 New Notifications
									</div>
									<div class="list-group">
										<a href="#" class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<i class="text-danger" data-feather="alert-circle"></i>
												</div>
												<div class="col-10">
													<div class="text-dark">Update completed</div>
													<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
													<div class="text-muted small mt-1">30m ago</div>
												</div>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<i class="text-warning" data-feather="bell"></i>
												</div>
												<div class="col-10">
													<div class="text-dark">Lorem ipsum</div>
													<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
													<div class="text-muted small mt-1">2h ago</div>
												</div>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<i class="text-primary" data-feather="home"></i>
												</div>
												<div class="col-10">
													<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
												</div>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<i class="text-success" data-feather="user-plus"></i>
												</div>
												<div class="col-10">
													<div class="text-dark">New connection</div>
													<div class="text-muted small mt-1">Christina accepted your request.</div>
													<div class="text-muted small mt-1">14h ago</div>
												</div>
											</div>
										</a>
									</div>
									<div class="dropdown-menu-footer">
										<a href="#" class="text-muted">Show all notifications</a>
									</div>
								</div>
							</li>
							<li class="nav-item dropdown d-none">
								<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
									<div class="position-relative">
										<i class="align-middle" data-feather="message-square"></i>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
									<div class="dropdown-menu-header">
										<div class="position-relative">
											4 New Messages
										</div>
									</div>
									<div class="list-group">
										<a href="#" class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
												</div>
												<div class="col-10 ps-2">
													<div class="text-dark">Vanessa Tucker</div>
													<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
													<div class="text-muted small mt-1">15m ago</div>
												</div>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
												</div>
												<div class="col-10 ps-2">
													<div class="text-dark">William Harris</div>
													<div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
													<div class="text-muted small mt-1">2h ago</div>
												</div>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
												</div>
												<div class="col-10 ps-2">
													<div class="text-dark">Christina Mason</div>
													<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
													<div class="text-muted small mt-1">4h ago</div>
												</div>
											</div>
										</a>
										<a href="#" class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
												</div>
												<div class="col-10 ps-2">
													<div class="text-dark">Sharon Lessman</div>
													<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
													<div class="text-muted small mt-1">5h ago</div>
												</div>
											</div>
										</a>
									</div>
									<div class="dropdrealown-menu-footer">
										<a href="#" class="text-muted">Show all messages</a>
									</div>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
					<i class="align-middle" data-feather="settings"></i>
				
				
				</a>

								<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<img src="./dashboard/images/google.png" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><?php echo $names ?></span>
				</a>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
									<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
									<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
									<div class="dropdown-divider"></div> -->
									<a class="dropdown-item" href="logout.php"><img src="/dashboard/images/logout.png" style="height:25px; margin-right:3px;">Log out</a>
					
								</div>
							</li>
						</ul>
					</div>
				</nav>
	
		
		