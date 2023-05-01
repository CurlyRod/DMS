
<?php 
    include 'db_connection.php';
    $files = $conn->query("SELECT * FROM tbl_files  WHERE  date_updated >= date_updated AND date_updated <= now() and user_id = ".$_SESSION['id']."  order by name asc");
    ?> 
<div class="row" > 
                    <div class="col-12"> 
                        <div class="card"> 
                            <div class="card-header"></div> 
                            <div class="card-body"> 
                            <div class="table-responsive">
                  <table
                    id="tblfiles"
                    class="table table-row-border data-table table-hover  "
                    style="width: 100%"
                  >
                    <thead >
                      <tr class="table text-black " style="background:#83C9FF;">
                    
							<th  class="text-center fw-normal "> Filename</th>
							<th  class="text-center fw-normal">Extension</th> 
							<th  class="text-center fw-normal">Filesize</th> 
							<!-- <th  class="text-center fw-normal">Description</th>  -->

							<th  class="text-center fw-normal">Date Uploaded</th> 
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
							<td><large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
						
							<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

							</td> 
							<td  class="text-center"><i class="to_file"><?php echo $row['file_type'] ?></i></td>
							<td  class="text-center"><i class="to_file"><?php echo $row['filesize'] ?></i></td>
							<td  class="text-center"><i class="to_file"><?php echo date('Y/m/d h:i:s A', strtotime($row['date_updated'])) ?></i></td>
							
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
                </div> 
				<script>  
				$('.viewFile').click(function(){ 
	var file_id = $(this).val(); 
	
	
	//  localStorage.setItem("getvalue",folder);
	location.href = 'admindashboard.php?page=readfiles&fileid='+ file_id;

});
				</script>