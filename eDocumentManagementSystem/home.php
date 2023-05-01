<?php include('db_connection.php') ;
          $files = $conn->query("SELECT f.*,u.firstname as uname FROM tbl_files f inner join tbl_users u on u.id = f.user_id where  f.is_public = 1 order by date(f.date_updated) desc");

          ?> 
			

<div class="container-fluid p-0"> 
	
			<h1 class="h3 mb-3"><strong>DASHBOARD</strong> </h1>

					<div class="row">
						<div class="col-xl-12 col-xxl-12 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card border ">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h3 class="card-title text-uppercase">Total Users</h3>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/profile.png"  style="height: 45px; width: 45px;"alt="">
														<!-- <img src="./img/sidebar/users.png" style="height:35px;width:32px;"> -->
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $conn->query('SELECT * FROM tbl_users where Archive = "Active"')->num_rows ?></h1>
											
											 	<div class="mb-0 text-end">
													
													<a href="" style="text-decoration:none;"><span class="text-muted ml-3 "></span></a>
													
												</div>
											</div>
										</div>
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">ARCHIVE</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/archive.png"  style="height: 45px; width: 45px;"alt="">
													
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $conn->query('SELECT * FROM tbl_files WHERE  archive = 3 ')->num_rows ?></h1>
											
												<div class="mb-0 text-end">
													
													<a href="" style="text-decoration:none;"><span class="text-muted ml-3 "></span></a>
													
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-uppercase">Total Files</h5>
													</div>

													<div class="col-auto">
														<div class="stat ">
														<!-- <i class="fa-solid fa-file"></i> --> 
														<img src="./img/sidebar/documents.png"  style="height: 45px; width: 45px;"alt="">
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $conn->query('SELECT * FROM tbl_files')->num_rows ?></h1>
												<div class="mb-0 text-end">
													
													<a href="" style="text-decoration:none;"><span class="text-muted ml-3 "></span></a>
													
												</div>
											</div>
										</div>
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">SHARED</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/social-media.png"  style="height: 45px; width: 45px;"alt="">
													
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"> 
													<?php require 'db_connection.php';

													echo $conn->query("SELECT a.username as uname,a.lastname as lname,u.user_id,u.date_upload as dateshare ,f.*FROM tbl_files f inner join tbl_share u on u.user_id = f.user_id INNER join tbl_users as a ON a.id = u.public_to WHERE u.user_id = '".$_SESSION['id']."' and f.id = u.file_id order by date(u.date_upload) desc")->num_rows?>
												</h1>
												<div class="mb-0 text-end">
													
													<a href="" style="text-decoration:none;"><span class="text-muted ml-3 "></span></a>
																									</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- <div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0 text-uppercase">Upload Monitoring</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
							</div>
						</div> -->
					</div>

					<div class="row">
						<div class="col-12 col-md-6 col-xxl-12 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0 text-uppercase">Pie Graph user type</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="py-3">
											<div class="chart chart-xs">
												<canvas id="chartjs-dashboard-pie"></canvas>
											</div>
										</div>

										<table class="table mb-0">
											<tbody>
												<tr>
													<td class="text-danger">Admin</td>
													<td class="text-end "><?php echo $conn->query('SELECT * FROM tbl_users where role ="Admin" and  Archive = "Active"')->num_rows ?></td>
												</tr>
												<tr>
													<td class="text-warning">Faculty</td>
													<td class="text-end"><?php echo $conn->query('SELECT * FROM tbl_users where role ="Faculty" and  Archive = "Active"')->num_rows ?></td>
												</tr>
												<tr>
													<td class="text-primary">User</td>
													<td class="text-end"><?php echo $conn->query('SELECT * FROM tbl_users where role="User" and Archive = "Active"')->num_rows ?></td>
										
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-12 col-xxl-12 d-flex order-3 order-xxl-2 d-none">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0 text-uppercase">Recent Uploads</h5>
								</div>
								<div class="card-body px-4">
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>Uploader</th>
											<th class="d-none d-xl-table-cell">Filename</th>
											<th class="d-none d-xl-table-cell"> Date</th>
											<th>Remarks</th>
											<th class="d-none d-md-table-cell">Approve</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Project Apollo</td>
											<td class="d-none d-xl-table-cell">Presentation.ppt</td>
											<td class="d-none d-xl-table-cell">31/06/2021</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Leo Arellano</td>
										</tr>
										<tr>
											<td>Project Fireball</td>
											<td class="d-none d-xl-table-cell">Presentation.ppt</td>
											<td class="d-none d-xl-table-cell">31/06/2021</td>
											<td><span class="badge bg-danger">Cancelled</span></td>
											<td class="d-none d-md-table-cell">Dangelo Buena</td>
										</tr>
										
										<tr>
											<td>Project Phoenix</td>
											<td class="d-none d-xl-table-cell">Presentation.ppt</td>
											<td class="d-none d-xl-table-cell">31/06/2021</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Rod Mark Rufino</td>
										</tr>
										<tr>
											<td>Project X</td>
											<td class="d-none d-xl-table-cell">Presentation.ppt</td>
											<td class="d-none d-xl-table-cell">31/06/2021</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Leo Arellano</td>
										</tr>
										<tr>
											<td>Project Romeo</td>
											<td class="d-none d-xl-table-cell">Presentation.ppt</td>
											<td class="d-none d-xl-table-cell">31/06/2021</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Dangelo Buena</td>
										</tr>
										
									</tbody>
								</table>
								</div>
							</div>
						</div>
						<!-- <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0 text-uppercase">Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
						<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0 text-uppercase">Upload Monitoring</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-12 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card border ">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h3 class="card-title text-uppercase">Total Admin </h3>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/profile.png"  style="height: 45px; width: 45px;"alt="">
														<!-- <img src="./img/sidebar/users.png" style="height:35px;width:32px;"> -->
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $conn->query('SELECT * FROM tbl_users where role="Admin" and Archive = "Active"')->num_rows ?></h1>
											
											 	<div class="mb-0 text-end">
													
													<a href="" style="text-decoration:none;"><span class="text-muted ml-3 "><i class="fa-solid fa-arrow-right fa-xl text-success d-none"></i></span></a>
													
												</div>
											</div>
										</div>
										<div class="card border d-none">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">ARCHIVE</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/archive.png"  style="height: 45px; width: 45px;"alt="">
													
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">10</h1>
												<div class="mb-0 text-end">
													
													<a href="" style="text-decoration:none;"><span class="text-muted ml-3 "><i class="fa-solid fa-arrow-right fa-xl text-success d-none"></i></span></a>
													
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-uppercase">Total Personal Files</h5>
													</div>

													<div class="col-auto">
														<div class="stat ">
														<!-- <i class="fa-solid fa-file"></i> --> 
														<img src="./img/sidebar/documents.png"  style="height: 45px; width: 45px;"alt="">
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $conn->query('SELECT * FROM tbl_files WHERE user_id ='.$_SESSION['id'])->num_rows ?></h1>
												<div class="mb-0 text-end">
													
													<a href="" style="text-decoration:none;"><span class="text-muted ml-3 "></span></a>
													
												</div>
											</div>
										</div>
										<div class="card border d-none">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">SHARED</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/social-media.png"  style="height: 45px; width: 45px;"alt="">
													
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"> 
													<?php require 'db_connection.php';

													echo $conn->query("SELECT a.username as uname,a.lastname as lname,u.user_id,u.date_upload as dateshare ,f.*FROM tbl_files f inner join tbl_share u on u.user_id = f.user_id INNER join tbl_users as a ON a.id = u.public_to WHERE u.user_id = '".$_SESSION['id']."' and f.id = u.file_id order by date(u.date_upload) desc")->num_rows?>
												</h1>
												<div class="mb-0 text-end">
													
													<a href="" style="text-decoration:none;"><span class="text-muted ml-3 ">See Details <i class="fa-solid fa-arrow-right fa-xl text-success"></i></span></a>
																									</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					
					
				</div>
				<script src="./src/js/flatpickr.js" type="text/javascript"> </script>  
   
			<script>  

document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() -0 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		}); 


			document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			var lineColor =gradient.addColorStop(0, "rgba(255, 135, 71, 0.8)");
		
			gradient.addColorStop(0, "rgba(0, 176, 142, 0.67)");
			gradient.addColorStop(1, "rgba(223, 176, 167, 0.82)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: <?php echo json_encode($labeldate)?>,
					datasets: [{
						label: " Upload",
						fill: true,
						backgroundColor: gradient,
						borderColor: lineColor,
						data: <?php	echo json_encode($totaluploads)?>
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		}); 
		
	
	
		</script>