

<div class="row"> 
<div class="col-3"> 
        <h1 class="h3  "><span><img src="./dashboard/images/eye.png" alt="" style="height:40px;width:40px;"> </span>PREVIEW</h1>
         </div> 
      
<div class="col-12"> 
                                    
                <?php
                
                  include 'db_connection.php'; 
                 
                  $qry = $conn->query("SELECT * FROM tbl_files where id=".$_GET['fileid'])->fetch_array();
                  extract($_POST); 
                  $realname = $qry['name'];
                  $fname=$qry['file_path'];
                  $file = ("assets/uploads/".$fname); 
                  $realfilename = explode('_',$file);
                  
                 
                    ?>

                <div class="card ">
				
				<div class="card-body vh-100 ">  
        <!-- <?php echo $realfilename[1]?>  -->
          <style> 
          embed[title]::after {
        content: attr(title);
        display: none;
        }
            </style>
              <embed  src="<?php echo $file?>" id="noTitle"type="" style=" height:100%; width:100%; ">
          
           <!-- <iframe src="https://docs.google.com/viewer?url=<<?php $file?>>&embedded=true"></iframe> -->

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
                <!-- <span><button class=" btn btn-success" id="backBtn"><i class="fa-solid fa-backward mr-1"></i>Back</button></span> -->
              
                </div>  
                    </div>                                     
							</div>
						</div>
					</div> 
          <script>  
          
          var embeds = document.getElementsByTagName('embed');
for (var i = 0; i < embeds.length; i++) {
    var title = embeds[i].getAttribute("title");
    if (title) {
        title.style.display = "none";
    }
}
//         $('#backBtn').click(function(){ 
// 	var file_id = $(this).val(); 
	
	
// 	//  localStorage.setItem("getvalue",folder);
// 	location.href = 'admindashboard.php?page=files';

// }); 
</script>
					
                    	