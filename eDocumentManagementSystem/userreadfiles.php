

<div class="row"> 
<div class="col-3"> 
        <h1 class="h3  "><span><img src="./dashboard/images/eye.png" alt="" style="height:40px;width:40px;"> </span>PREVIEW</h1>
         </div> 
      
<div class="col-12"> 
                                    
                <?php
                  include 'db_connection.php'; 
                 
                  $qry = $conn->query("SELECT * FROM tbl_files where id=".$_GET['fileid'])->fetch_array();
                  extract($_POST);
                  $fname=$qry['file_path'];
                  $file = ("assets/uploads/".$fname);
                    ?>

                <div class="card ">
				
				<div class="card-body vh-100 ">  
                   
                <embed src="<?php echo $file?>" type="" style=" height:100%; width:100%; ">

  
                </div>  
                <div class="row"> 
                       <h5 class="ml-4 fw-bold">DESCRIPTION</h5>
                        <div class="col-5 "> 
                        <h5 class="ml-4"><b>Filename:</b> <?php  echo $name=$qry['name'].'.'.$qry['file_type']; ?></h5>
					    <h5 class="ml-4"><b>Filetype:</b> <?php echo $filetype=$qry['file_type'];  ?></h5> 
                        </div> 
                        <div class="col-5 "> 
                        <h5 class="ml-4 mt-2"><b>Size:</b><?php  echo $name=$qry['filesize']; ?></h5>
					    <h5 class="ml-4 mt-2"><b>Date upload:</b> <?php echo $filetype=$qry['date_updated'];  ?></h5> 
               
                        </div> 
                        <div class="col-2 mt-2"> 
                <span><button class=" btn btn-success" id="backBtn"><i class="fa-solid fa-backward mr-1"></i>Back</button></span>
              
                </div>  
                    </div>                                     
							</div>
						</div>
					</div> 
          <script> 
//         $('#backBtn').click(function(){ 
// 	var file_id = $(this).val(); 
	
	
// 	//  localStorage.setItem("getvalue",folder);
// 	location.href = 'userdashboard.php?page=files';

// }); 
</script>
					
                    	