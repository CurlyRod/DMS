<?php include('db_connection.php') ;
          $files = $conn->query("SELECT f.*,u.firstname as uname FROM tbl_files f inner join tbl_users u on u.id = f.user_id where  f.is_public = 1 order by date(f.date_updated) desc");

          ?> 
			

<div class="container-fluid p-0"> 
	
			<h1 class="h3 mb-3"><strong>DASHBOARD</strong> </h1>

					<div class="row">
						
						<div class="col-xl-6 col-xxl-7 ">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title  text-uppercase">Upload Monitoring</h5>
								</div>
								<div class="card-body py-2 ">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
								
							</div> 
							
						</div>
				 


						<div class="col-xl-6 col-xxl-5 d-flex  ">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card border  ">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h3 class="card-title text-uppercase">Total Folder</h3>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/folder.png"  style="height: 45px; width: 45px;"alt="">
														<!-- <img src="./img/sidebar/users.png" style="height:35px;width:32px;"> -->
														</div>
													</div>
												</div>
												
											 	<div class="row">
													<div class="col">  
													<h1 class="mt-1 mb-2"><?php echo $conn->query('SELECT * FROM  tbl_folders ')->num_rows ?></h1>
											
                                                    <a href="admindashboard.php?page=totalfolders" class=""> 
                                                    <button class="btn btn-info btn-sm" style="width:75px;">  FOLDER  </button>
                                                    </a>
                                                    </div>
													
                                                    <div class="col">  
														
                                                    <a href="admindashboard.php?page=totalfolder" class="">  
													<h1 class="mt-1 mb-2"><?php echo $conn->query('SELECT * FROM  tbl_folders  WHERE archive = 1')->num_rows ?></h1>
											
                                                    <button class="btn btn-info btn-sm" style="width:76px;">  ARCHIVE </button>
                                                    </a>
                                                    </div>
                                                	
												</div>
											</div> 
                                            
										</div>
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">TOTAL ACCOUNT</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/archive.png"  style="height: 45px; width: 45px;"alt="">
													
														</div>
													</div>
												</div>
												<div class="row"> 
													<div class="col">
													<h1 class="" ><?php echo $conn->query("SELECT * FROM tbl_users WHERE archive ='Active'")->num_rows;?>
													</h1> 
                                                    <a href="admindashboard.php?page=archivemodule/archiveuser" class=""> 
                                                    <button class="btn btn-primary btn-sm" style="width:78px;"> User </button>
                                                    </a> 
													</div> 

													<div class="col">
													<h1 class="" ><?php echo $conn->query("SELECT * FROM tbl_users WHERE archive ='Disable'")->num_rows;?>
													</h1> 
                                                    <a href="admindashboard.php?page=totaluser" class=""> 
                                                    <button class="btn btn-primary btn-sm" style="width:78px;"> Archive </button>
                                                    </a> 
													</div>
													
													
													 
													
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title text-uppercase">TOTAL Files</h5>
													</div>

													<div class="col-auto">
														<div class="stat ">
														<!-- <i class="fa-solid fa-file"></i> --> 
														<img src="./img/sidebar/documents.png"  style="height: 45px; width: 45px;"alt="">
														</div>
													</div>
												</div> 
                                                <div class="row"> 
                                                <div class="col">
                                                <h1 class="mt-1 mb-2"><?php echo $conn->query('SELECT * FROM  tbl_files WHERE archive = 0')->num_rows ?></h1>												
                                                <a href="admindashboard.php?page=totalfiles" class=""> 
                                                    <button class="btn btn-info btn-sm" style="width:75px;">  FILE  </button>
                                                    </a>	
                                                </div> 
                                                <div class="col"> 
                                                <h1 class="mt-1 mb-2"><?php echo $conn->query("SELECT * FROM tbl_files WHERE archive = 3 " )->num_rows ?></h1>												
												<a href="admindashboard.php?page=archivemodule/archivefiles" class=""> 
                                                    <button class="btn btn-info btn-sm" style="width:76px;"> ARCHIVE </button>
                                                    </a>	
                                                </div>
                                                </div>
												
    
												
											</div>
										</div>
										<div class="card border">
											<div class="card-body">
												<div class="row">
													<div class="col ">
														<h5 class="card-title">TOTAL SHARED</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
														<img src="./img/sidebar/social-media.png"  style="height: 45px; width: 45px;"alt="">
													
														</div>
													</div>
												</div>
												

												<div class="row"> 
													<div class="col "> 
													<h1 class="" ><?php echo $conn->query("SELECT a.username as uname,a.lastname as lname,u.user_id,u.date_upload as dateshare ,f.*FROM tbl_files f inner join tbl_share u on u.user_id = f.user_id INNER join tbl_users as a ON a.id = u.public_to  and f.id = u.file_id ")->num_rows?>
											
													</h1> 
                                                    <a href="admindashboard.php?page=totalshared" class=""> 
                                                    <button class="btn btn-primary btn-sm" style="width:75px;">  FILE  </button>
                                                    </a>
													
													</div> 
													<div class="col "> 
													<h1 class=""><?php echo $conn->query("SELECT u.public_to,a.username as uname,a.lastname as lname,u.user_id,u.date_shared as dateshare ,f.*FROM tbl_folders f inner join tbl_share_folder u on u.user_id = f.user_id INNER join tbl_users as a ON a.id = u.public_to  and f.id = u.folder_id WHERE u.public_to = a.id")->num_rows;?>
													</h1>  
                                                    <a href="admindashboard.php?page=adminlinkfolder"> 
                                                        <button class="btn btn-primary btn-sm" style="width:75px;">FOLDER</button>
                                                    </a>
												
													</div>
												</div>

												
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				
			<div class="row" > 
                    <div class="col-12">  
						<?php 
						$files = $conn->query("SELECT a.role as type, a.firstname as uname,a.lastname as lname, u.date_upload as dateshared, u.message as message ,f.*FROM tbl_files f inner join tbl_share u on u.user_id = f.user_id INNER join tbl_users as a ON f.user_id =a.id WHERE  date(u.date_upload)= CURDATE() and f.archive = 0 and u.public_to ='".$_SESSION['id']."' and f.id = u.file_id  GROUP BY f.id order by date(f.date_updated) desc");

       
						?>
                        <div class="card"> 
                             
                            <div class="card-body">  
							<div class="card-title text-uppercase"> 
							
							receive files today
							</div>
                            <div class="table-responsive">
                  <table
                    id="tblfiles"
                    class="table table-row-border data-table table-hover  "
                    style="width: 100%"
                  >
                    <thead >
                      <tr class="table text-black " style="background:#83C9FF;">
                    
					  <th  class="text-center fw-normal "> Uploader</th>	
					  <th  class="text-center fw-normal "> Filename</th>
							<th  class="text-center fw-normal">Extension</th> 
							<th  class="text-center fw-normal">Filesize</th> 
							<!-- <th  class="text-center fw-normal">Description</th>  -->

							<th  class="text-center fw-normal">Message</th> 
							<th  class="text-center fw-normal">Date Shared</th>  
							
							<th class="text-center fw-normal"></th>
           
                      </tr>
                    </thead> 

                    <tbody>
						<?php 
					while($row=$files->fetch_assoc()):
						$name = explode(' ||',$row['name']);
						$name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type'] : $name[0] .".".$row['file_type'];
						$img_arr = array('png','jpg','jpeg','gif','psd','tif');
						$doc_arr =array('doc','docx');
						$pdf_arr =array('pdf','ps','eps','prn');
						$icon ='fa-file';
						if(in_array(strtolower($row['file_type']),$img_arr))
							$icon ='fa-image text-primary';
						if(in_array(strtolower($row['file_type']),$doc_arr))
							$icon ='fa-file-word text-info';
						if(in_array(strtolower($row['file_type']),$pdf_arr))
							$icon ='fa-file-pdf text-danger';
						if(in_array(strtolower($row['file_type']),['xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr']))
							$icon ='fa-file-excel text-success';
						if(in_array(strtolower($row['file_type']),['zip','rar','tar']))
							$icon ='fa-file-archive text-warning';

					?>
						<tr class='file-item fw-light' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
						<td  class="text-center text-info"><i class="to_file"><?php echo $row['type'].'~'.$row['uname'].' '.$row['lname'] ?></b></i></td>
						
						  
						<td><large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
						
							<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

							</td>  
							
							<td  class="text-center"><i class="to_file"><?php echo $row['file_type'] ?></i></td>
							<td  class="text-center"><i class="to_file"><?php echo $row['filesize'] ?></i></td> 
							<td  class="text-center"><i class="to_file"><?php echo $row['message'] ?></i></td>
							
							<td  class="text-center"><i class="to_file"><?php echo date('Y/m/d h:i:s A', strtotime($row['dateshared'])) ?></i></td>
						
							<!-- <td class="text-center"><i class="to_file"><?php echo $row['description'] ?></i></td> -->
							
							<td>
								<center>
								<div class="dropdown">
								<button class="btn btn-sm " type="button" data-bs-toggle="dropdown" aria-expanded="false" >
								<img src="./dashboard/images/down.png" alt="" style="height:20px;width:20px;">
								</button>
								<ul class="dropdown-menu "> 
								<li><a class="dropdown-item "><button class="viewFile btn" value='<?php echo $row['id']?>'><img src="./dashboard/images/eye.png" style="width:20px;heigth:20px;"> 
									Preview</button></a></li>
									
									<li><a class="dropdown-item"><button class="downloadFile btn" value='<?php echo $row['id']?>'><img src="./dashboard/images/download.png" style="width:20px;heigth:20px;"> 
									Download</button></a></li> 
									
										
									
						</ul>
						</div>
										</center>
							</td>
						</tr>
							
					<?php endwhile; ?> 
					</tbody>
					</table>
					
					</div>
				
				
			
                            </div>
                        </div>
                    </div>

					<div class="row d-none">
						<div class="col-12 col-12 col-xxl-12 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0 text-uppercase">Pie Graph user type</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="py-1">
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
					
                </div>  
				
				<script>  
	$('.viewFile').click(function(){ 
	var file_id = $(this).val(); 
	
	
	//  localStorage.setItem("getvalue",folder);
	location.href = 'userdashboard.php?page=readfiles&fileid='+ file_id;

}); 
$('.downloadFile').click(function(){ 
	var user_id = $(this).val();
    // alert(user_id );  
	 location.href = 'download.php?id='+user_id;
	
});
				</script>
					<div class="row">
					

				</div>
				<script src="./src/js/flatpickr.js" type="text/javascript"> </script>  
   
			<script>  
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
						label: "My uploads",
						fill: true,
						backgroundColor: gradient,
						borderColor: lineColor,
						data: <?php echo json_encode($totaluploads)?>,
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