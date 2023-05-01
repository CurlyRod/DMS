<style>  
#cardfiles{ 
   
    border-shadow:none;
}


div#paths a {
    color: #929292; 
	
} 
div#paths a:hover {
   text-decoration:none; 
   color:white;
   background:#222E3C; 
   border-radius:2px;
	
}
	.folder-item{
	cursor: pointer;  
	border:0;
	transition: transform .1s;  
	
		
	}
	.folder-item img:hover{
		
	    color: black; 
		transform: scale(1.1); 
		
	    
	}
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
} 
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
.file-item{
	cursor: pointer; 

} 
a.addfolder img:hover{  
	cursor: pointer;  
	transform: scale(1.3);
	transition: transform .3s; 
	

} 

a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}

a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
} 
</style>

<?php 
    include 'db_connection.php';
    $folder_parent = isset($_GET['fid'])? $_GET['fid'] : 0; 

    $folders = $conn->query("SELECT * FROM tbl_colab_folder where parent_colab_id = $folder_parent and archive = 0  and creator_id = '".$_SESSION['id']."'  order by foldername asc");


    // $files = $conn->query("SELECT * FROM tbl_files where archive = 0  and folder_id = -1  and user_id = '".$_SESSION['id']."'  order by name asc");
   
  

    $files = $conn->query("SELECT a.role as type, a.firstname as uname,a.lastname as lname, f.*FROM tbl_files f INNER join tbl_users as a ON f.user_id =a.id WHERE f.folder_id = $folder_parent GROUP BY f.id order by date(f.date_updated) desc");

  
  
    //  $files = $conn->query("SELECT * FROM tbl_files where IF (folder_id =0 ,folder_id = 0,  folder_id = -1 )   and user_id = 3 and  archive = 0  order by name asc");
  
    ?> 
    <div class="row ">    
        <!-- Modal add file -->
	<div class="modal fade" id="addFilesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header p-2">
      <img src="./img/sidebar/folders.png" style="height:50px;width:50px;" alt=""><h6 class="modal-title  text-center mt-3 ml-2" id="exampleModalLabel">Add File</h6> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  

    
	  <form method="POST" id="uploadForm" enctype="multipart/form-data">  

    <div class="alert alert-primary d-none">NOTE: Uploading any explicit File,Video,Image, or any File unrelated 
      to academic purposes will be punished accordingly.
    </div> 

	 	<div id ="errorMessage"class="alert alert-danger d-none"></div> 
		 <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">

 		 <input type="hidden" name="folder_ids" id="folder_ids" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>">
		 
	  <div class="row">  
            <div class="col-8"> 
            <input type="file" name="file[]" id="fileInput[]" multiple required >   
            </div> 
            <div class="col-4 d-flex justify-content-end"> 
             
		</div> 
          </div>  
		  <div class="progress mt-3 " >
            <div class="progress-bar  progress-bar-striped"></div>
        </div>
		  <!-- <div class="row mt-4"> 
        
			<label >Description</label>
		  <textarea name="desc" id="desc" cols="35" rows="4"></textarea>
		  
		</div>  -->
		<div class="modal-footer mb-1"> 
		<input class="btn btn-danger  text-white" type="button" id="btnCancel" value="CANCEL" />
    <input class="btn btn-success  text-white"  type="submit" name="submit" value="UPLOAD" />
    
		</div>
		<div id="uploadStatus"></div>
	</form> 
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="cancel" >cancel</button> 
        <button type="submit" class="btn btn-success">Save changes</button>
      </div> -->
    </div>
  </div>
</div>  
<!--ADD FOLDER IN--> 
<div class="modal fade" id="addFolderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> 
	<span> 
	<img src="./dashboard/images/folder (3).png" style="height:45px;"> Add Folder
        
	</span>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
	  <div id ="foldererrorMessage"class="alert alert-warning d-none"></div> 
		<form action="" id="savefolder">
		<div class="row">  
		<input type="hidden" id="folder_parent" name="folder_parent"  
                      value="<?php 
                             if(isset($_GET['fid'])) 
                             { 
                                echo $_GET['fid'];
                             }
                             ?> ">
                    		
		<div class="col-4"> 
			Folder Name
		</div>  
		
		<div class="col-12 mt-1">
		<input type="text" id="folder_names" name="folder_names" class="form-control" required pattern="[a-zA-Z0-9\s]+"/>
	
		</div>
			</div> 
			<div class="modal-footer mb-1"> 
		<input class="btn btn-success  text-white"  type="submit" name="submit" value="SUBMIT" />
			 
		</div>
      </div>
	  
		</form>
    </div>
  </div>
</div> 

<div class="modal fade" id="updateFolderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> 
	<span> 
	<img src="./dashboard/images/folder (3).png" style="height:45px;"> Update Folder
        
	</span>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
	  <div id ="foldererrorMessage"class="alert alert-warning d-none"></div> 
		<form action="" id="updatefolder">
		<div class="row">   
		<input type="hidden" name="f_id" id="f_id"> 
		<input type="hidden" id="updatefolder_parent" name="updatefolder_parent"  
                      value="<?php 
                             if(isset($_GET['fid'])) 
                             { 
                                echo $_GET['fid'];
                             }
                             ?> ">
                    
                       
                
		<div class="col-4"> 
			Folder Name
		</div>  
		
		<div class="col-12 mt-1">
		<input type="text" id="updatefolder_names" name="updatefolder_names" value =""class="form-control" require>
	
		</div>
			</div> 
			<div class="modal-footer mb-1"> 
		<input class="btn btn-success  text-white"  type="submit" name="submit" value="SUBMIT" />
			 
		</div>
      </div>
	  
		</form>
    </div>
  </div>
</div>

    <div class="col-3">  
      <input type="hidden" name ="flder_id"id="flder_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>"> 

        <h1 class="h3  "><span><img src="./dashboard/images/team-work.png" alt="" style="height:40px;width:40px;"> </span>Workstation</h1>
        </div> 
      
        <div class="col-9"  >
        	 <div class="col text-end text-dark bg-light   border border-muted shadow-sm mt-3 pr-1 mb-2 bg-body rounded" id="paths">
             <?php 
				$id=$folder_parent;
				while($id > 0){

					$path = $conn->query("SELECT * FROM tbl_colab_folder where id = $id  order by foldername asc")->fetch_array();
					echo '<script>
						$("#paths").prepend("<a href=\"admindashboard.php?page=admincollab&fid='.$path['id'].'\">'.$path['foldername'].'</a>/")
					</script>';
					$id = $path['parent_colab_id'];

				}
				echo '<script>
						$("#paths").prepend("Directory: <a href=\"admindashboard.php?page=admincollab\">Home</a>/")
					</script>';
				?>
					</div>
   	 
        </div>
        
    </div>
   

					<div class="row">
						<div class="col-12">
							<div class="card"> 
								<div class="card-header ">
                           <div class="row"> 
                           <div class="col-6"> 
                         
                 <a class="addfolder ms-1" data-bs-toggle="modal" data-bs-target="" id="addFiles" ><img  src="./src/img/photos/f (1).png "style="height:40px; width:40px;"></a>
                 
				 <a class="addfolder ms-3" id="addfolders" data-bs-toggle="modal" data-bs-target="#addFolderModal"> 
                 <img  src="./src/img/photos/f (2).png"style="height:40px; width:40px;"></a>
         
                         
                         
                </div> 
                <div class="col-6 justify-content-end "> 
                <div class="input-group ">
		
        <input type="text" class="form-control bg-transparent rounded" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >
        <div class="input-group-append">
              <span class="input-group-text bg-transparent border-0"  id="inputGroup-sizing-sm"><img src="./dashboard/images/search.png "style="height:25px;width:30px;" alt=""></span>
        </div>
                           
                </div>
							
                           </div>
                
            </div> 
            
								<div class="card-body"> 
                                                    <div class="row col-12 mb-3 ml-1" style="overflow: scroll; height:180px; ">
                        <?php 
                            while($row=$folders->fetch_assoc()):
                            ?>
                                
                                <div class="card text-center col-md-3 p-1  folder-item  " id="cardfiles" data-id="<?php echo $row['id'] ?>" style="box-shadow:none;">
                                    
                               
                                <div class="card-body">
                                    
                                            <span> 
                                            <large><img src="./img/photos/yellow.png" style="height:95px; width:100x;"> <p class="to_folder  " style="font-size:13px; "> <b><?php echo $row['foldername'] ?></b> </p></large> </p></large>
									                  	<!-- <input type="text"value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :0 ?>">  -->
                                      
                                            </span>
                                            
                                        </div> 
                                       
                                        
                                </div> 
                                
                                
			<?php endwhile; ?>  
		

								</div>
							</div>
						</div>
					</div> 
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
                    
              <th  class="text-center fw-normal "> Uploader</th>				 
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
            <td class="text-center fw-semi-bold text-primary "><i><?php echo ucwords($row['type'].'~ '.$row['uname'].' '.$row['lname']) ?></i></td>
             
            <td><large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
						         
							<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

							</td> 
							<td  class="text-center"><i class="to_file"><?php echo $row['file_type'] ?></i></td>
							<td  class="text-center"><i class="to_file"><?php echo $row['filesize'] ?></i></td>
							<td  class="text-center"><i class="to_file"><?php echo date('Y/m/d h:i:s A', strtotime($row['date_upload'])) ?></i></td>
							
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
									<!-- <li><a class="dropdown-item"><button class="editUser btn" value='<?php echo $row['id']?>'><img src="./dashboard/images/pencil.png" style="width:20px;heigth:20px;"> 
									Edit</button></a></li>   -->
                                
									<li><a class="dropdown-item"><button class="downloadFile btn" value='<?php echo $row['id']?>'><img src="./dashboard/images/download.png" style="width:20px;heigth:20px;"> 
									Download</button></a></li> 
									
										
									<li><a class="dropdown-item"><button value='<?php echo $row['id']?>' class="deleteFile btn" ><img src="./dashboard/images/delete.png" style="width:20px;heigth:20px;"> Delete</button> </a></li>
								
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
  



                <div id="menu-folder-clone" style="display: none;"> 

<a href="javascript:void(0)" class="custom-menu-list file-option edit"id="edits"><span><i class="fa fa-edit fa-lg" style="color:#FFAA13;margin-right:5px;"></i> Rename</span> </a>
<a href="javascript:void(0)" class="custom-menu-list file-option delete" id="deletes"> <span><i class="fa fa-trash fa-lg" style="color:#F93A68; margin-right:5px;"></i>  Delete</span></a>
<a href="javascript:void(0)" class="custom-menu-list file-option delete" id="sharefolder"> <span><i class="fa-solid fa-share-nodes fa-lg text-primary " style="color:#F93A68; margin-right:5px;"></i>  Share Folder</span></a>
<a href="javascript:void(0)" class="custom-menu-list file-option delete" id="unlinkFolder"> <span><i class="fa-solid fa-link  text-danger " style="color:#F93A68; margin-right:5px;"></i>  Update share</span></a>

<!-- <a href="javascript:void(0)" class="custom-menu-list file-option share" id="foldershare"><span><i class="fa-solid fa-share-nodes fa-lg text-primary "style="margin-right:5px;"></i>Share Folder</span></a> -->
</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="./src/alertify/alertify.min.js" type="text/javascript"></script>
           <script>
 



 let element = document.getElementById("addFiles");

 let folder_id = document.getElementById("folder_ids").value;

if (folder_id== 0) {
  element.style.display = "none";
} else {
  element.style.display = "inline";
}




$('#folder_names').bind('#folder_names', function() {
  var c = this.selectionStart,
      r = /[^a-z0-9 .]/gi,
      v = $(this).val();
  if(r.test(v)) {
    $(this).val(v.replace(r, ''));
    c--;
  }
  this.setSelectionRange(c, c);
});
  


$(document).on('click','#unlinkFolder',function(){ 
		 
     var flderid = $(this).attr("data-id");
          location.href=('admindashboard.php?page=adminupdatecollabfolder&uqfolderid='+flderid );
  
      });



// function typeValidation(type){
//      var splitType =type.split('/')[0] 
//      if(type == 'application/pdf' || splitType=='image' || splitType == 'video')
//      { 
//         return true
//      }
// } 
function timedRefresh(timeoutPeriod) {
    setTimeout("location.reload(true);",timeoutPeriod);   
      }

$('.folder-item').click(function(){
location.href = 'admindashboard.php?page=admincollab&fid='+$(this).attr('data-id')
})      
$('#addFiles').click(function(e){ 
 
  var flder_id = document.querySelector("#flder_id"); 
  var value = flder_id.value;
console.log(value);
 location.href = 'admindashboard.php?page=adminfileupload&fid='+ value;
})   

$('.downloadFile').click(function(){ 
	var user_id = $(this).val();
    // alert(user_id );  
	 location.href = 'download.php?id='+user_id;
	
}); 
$('.viewFile').click(function(){ 
	var file_id = $(this).val(); 
	
	//  localStorage.setItem("getvalue",folder);
	location.href = 'admindashboard.php?page=readfiles&fileid='+ file_id;

}); 




$(document).on('click','.fileId',function()
          { 
            
            var user_id = $(this).val();
           alert(user_id );
          })

$('.folder-item').bind("contextmenu", function(event) { 
event.preventDefault(); 

$("div.custom-menu").hide();
var custom =$("<div class='custom-menu'></div>")
custom.append($('#menu-folder-clone').html())
 custom.find('.edit').attr('data-id',$(this).attr('data-id'))
custom.find('.delete').attr('data-id',$(this).attr('data-id'))
custom.appendTo("body")
custom.css({top: event.pageY + "px", left: event.pageX + "px"});

// $("div.custom-menu .delete").click(function(e){
// e.preventDefault()
// _conf("Are you sure to delete this Folder?",'delete_folder',[$(this).attr('data-id')])
// })
})

//FILE
$('.file-item').bind("contextmenu", function(event) { 
event.preventDefault();

$('.file-item').removeClass('active')
$(this).addClass('active')
$("div.custom-menu").hide();
var custom =$("<div class='custom-menu file'></div>")
custom.append($('#menu-file-clone').html())
custom.find('.edit').attr('data-id',$(this).attr('data-id'))
custom.find('.delete').attr('data-id',$(this).attr('data-id'))
custom.find('.download').attr('data-id',$(this).attr('data-id'))
custom.find('.viewfiles ').attr('data-id',$(this).attr('data-id'))
custom.appendTo("body")
custom.css({top: event.pageY + "px", left: event.pageX + "px"});

// $("div.file.custom-menu .edit").click(function(e){
// e.preventDefault()
// $('.rename_file[data-id="'+$(this).attr('data-id')+'"]').siblings('large').hide();
// $('.rename_file[data-id="'+$(this).attr('data-id')+'"]').show();
// })
// $("div.file.custom-menu .delete").click(function(e){
// e.preventDefault()
// _conf("Are you sure to delete this file?",'delete_file',[$(this).attr('data-id')])
// })
// $("div.file.custom-menu .download").click(function(e){
// e.preventDefault()
// window.open('download.php?id='+$(this).attr('data-id'))
// })
// $("div.file.custom-menu .viewfiles").click(function(e){
//   e.preventDefault()

//   window.open('view_document.php?id='+$(this).attr('data-id')) 

// })
 





}) 
$('#addFilesModal').on('hidden.bs.modal', function () {
    $(this).find('#addfiles').trigger('reset');
}) 
function myFunction() {
            document.getElementById("userfile").reset();
        }
//FILE


// $('.file-item').click(function(){
// if($(this).find('input.rename_file').is(':visible') == true)
// return false;
// uni_modal($(this).attr('data-name'),'manage_files.php?<?php echo $folder_parent ?>&id='+$(this).attr('data-id'))
// }) 

$(document).bind("click", function(event) {
$("div.custom-menu").hide();
$('#file-item').removeClass('active')

}); 

$(document).keyup(function(e){

if(e.keyCode === 27){
$("div.custom-menu").hide();
$('#file-item').removeClass('active')

}

});
$(document).ready(function(){
$('#search').keyup(function(){
	var _f = $(this).val().toLowerCase()
	$('.to_folder').each(function(){
		var val  = $(this).text().toLowerCase()
		if(val.includes(_f))
			$(this).closest('.card').toggle(true);
			else
			$(this).closest('.card').toggle(false);

		
	})
	$('.to_file').each(function(){
		var val  = $(this).text().toLowerCase()
		if(val.includes(_f))
			$(this).closest('tr').toggle(true);
			else
			$(this).closest('tr').toggle(false);

		
	})
})
})  


 

//FOR UPLOAD FILES
$(document).ready(function(){ 
    // File upload via Ajax
    $("#uploadForm").on('submit', function(e){
		
		e.preventDefault();   

		
        var formData = new FormData(this);  
            formData.append("upload_Form" ,true);
            
        $.ajax({
          
			
			xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100).toFixed(1);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            }, 

 
            type: 'POST',
            url: 'savesfile.php',
            data:formData,
            contentType: false,
            cache: false,
            processData:false, 
            
            beforeSend: function(){

                $(".progress-bar").width('0%');
                // $('#uploadStatus').html('<img src="images/loading.gif"/>');
            },
          
            // success: function(response){
			// 	var res = jQuery.parseJSON(response);

            //     if(res.status == 200){
            //       $('#uploadForm')[0].reset();
            //         $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>').fadeOut(7000);;
            //         $(".progress-bar").fadeOut(7000); 
            //        // window.onload = timedRefresh(2000);
     
            //     }else if(res == 400){
            //         $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
            //     }
            // } 
			
			
			success:function(response) {   

			var res = jQuery.parseJSON(response);

			if(res.status == 300) 
			{  
        $('#errorMessage').removeClass('d-none');   
				$('#errorMessage').text(res.message);  
        $(".progress-bar").width('0%'); 
        // alertify.set('notifier','position', 'top-right');
				// alertify.success(res.message);  
				console.log();  
			}else if(res.status == 200)
			{ 	
				//$('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>').fadeOut(7000);;
                
					
				alertify.set('notifier','position', 'top-right');
				alertify.success(res.message);  
				// alertCustomize() ;
                // $('.msg').text(res.message);  

				$('#errorMessage').addClass('d-none');   
				// $('#addUserModal').modal('hide'); 
				setTimeout(function() { $('#addFilesModal').modal('hide'); }, 2000); 

				$('#uploadForm')[0].reset(); 
				  
				
				 $('#tblfiles').load(location.href+ " #tblfiles"); 
				 window.onload = timedRefresh(2000); 
				}


					
			}
			});

		
        });
    });
 
//FOR UPLOAD FILES END

$(document).on('click','.deleteFile',function(e){   
              e.preventDefault();


              Swal.fire({
                  title: 'Are you sure to delete this file data?',
                  icon: 'warning', 
                  width:'500px' ,  
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
                
                
               }).then((result) => {
                  if (result['isConfirmed']){
                     // Put your function here
                     
                     var file_id  =$(this).val(); 


                        $.ajax({ 

                        type:"POST", 
                        url: "savefile.php",
                        data:{ 
                        'delete_item':true,  
                        'file_id':file_id
                        }, 
                        success: function(response){  
                        var res = jQuery.parseJSON(response);
                        if(res.status == 500){ 
				              			alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                        }else if(res.status == 200){ 
                              alertify.set('notifier','position', 'top-right');
                              alertify.set('notifier','delay', 1);
                              alertify.success(res.message); 
                            $('#tblfiles').load(location.href+ " #tblfiles"); 
                            window.onload = timedRefresh(1000);  
                    
                         
                        }
                        }

                        });

                  }  
                  
                 
               });
          });   


		  $(document).on('submit' , '#savefolder',function(e){  
            e.preventDefault(); 
            
            var formData = new FormData(this);  
            formData.append("save_folder" ,true);
            
            $.ajax({  
              type:"POST", 
              url: "collabaddfolder.php",
              data:formData, 
              processData:false, 
              contentType:false,
                success:function(response) {   

                  var res = jQuery.parseJSON(response);

                  if(res.status == 404) 
                  {  
                        $('#foldererrorMessage').removeClass('d-none');   
                        $('#foldererrorMessage').text(res.message);  
                  }else if(res.status == 200)
                  { 
                        $('#foldererrorMessage').addClass('d-none');   
                        $('#addFolderModal').modal('hide'); 
                        
                          alertify.set('notifier','position', 'top-right'); 
                          alertify.set('notifier','delay', 1);
                           alertify.success(res.message);  
                        // alertCustomize() ;
                        // $('.msg').text(res.message);  

                        $('#tblfiles').load(location.href+ " #tblfiles"); 
                          window.onload = timedRefresh(1000);  
                        $('#savefolder')[0].reset();  
                      //  $(".modal-backdrop").hide(); 
                         
                    //   $('#tblUsers').load(location.href+ " #tblUsers"); 
                                  

                      } 
                }
            });



          }); 

 $(document).on('click','#sharefolder',function(){ 


var flder_id = $(this).attr("data-id");
// alert(flder_id); 
// var fileId = $(this).val();
location.href=('admindashboard.php?page=admincollabfolder&folderid='+flder_id);


});
		
	$(document).on('click','.shareFile',function(){ 
		 
		var fileId = $(this).val();
		location.href=('admindashboard.php?page=fileshare&fileid='+fileId);

	}); 
  


$(document).on('click','#btnCancel',function(e)
{ 
  e.preventDefault(); 
  window.onload = timedRefresh(100);   
  $("#addFilesModal").modal("hide");
  

});

	
	
$(document).on('click','#edits',function(e)
{ 
	e.preventDefault(); 
	var flder_id = $(this).attr("data-id") 
	//alert(flder_id);
		$.ajax({  

			type:"GET",
			url:"collabaddfolder.php?folderid="+flder_id,
			success: function(response){ 
			  var res = jQuery.parseJSON(response);
			  if(res.status == 404){ 
				$('#foldererrorMessage').removeClass('d-none');   
				 $('#foldererrorMessage').text(res.message); 
			  }else if(res.status == 200)
			  { 
					$('#f_id').val(res.data.id);
					$('#updatefolder_parent').val(res.data.parent_id);  
					$('#updatefolder_names').val(res.data.foldername);
					$('#updateFolderModal').modal('show'); 
					
			  }
			}

		});



}) 

$(document).on('submit','#updatefolder',function(e){  
            e.preventDefault(); 
            
            var formData = new FormData(this);  
            formData.append('update_folder' ,true);
            
            $.ajax({ 
              type:"POST", 
              url: "collabeditfolder.php",
              data:formData, 
              processData:false, 
              contentType:false,
                success:function(response) {   

                  var res = jQuery.parseJSON(response);

                  if(res.status == 422) 
                  {  
                        $('#foldererrorMessage').removeClass('d-none');   
                        $('#foldererrorMessage').text(res.message);  
                  }else if(res.status == 200)
                  { 
                        $('#foldererrorMessage').addClass('d-none');   
                        $('#updateFolderModal').modal('hide'); 
                        $('#updatefolder')[0].reset(); 
                          
                        alertify.set('notifier','position', 'top-right');
                        alertify.set('notifier','delay',1);
						alertify.success(res.message);

						window.onload = timedRefresh(1000); 
                      } 
                }
            });



          });   



          
          $(document).on('click','#deletes',function(e){   
              e.preventDefault();
            
              Swal.fire({
                  title: 'Are you sure to delete this folder and its and content?',
                  icon: 'warning', 
                  width:'500px' ,  
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
                
                
               }).then((result) => {
                  if (result['isConfirmed']){
                     // Put your function here
                     
                   //  var file_id  =$(this).val(); 
                   var folder_id = $(this).attr("data-id")  
                //  alert(folder_id);

                        $.ajax({ 

                        type:"POST", 
                        url: "savefile.php",
                        data:{ 
                        'delete_collab_folder':true,  
                        'folder_id':folder_id
                        }, 
                        success: function(response){  
                        var res = jQuery.parseJSON(response);
                        if(res.status == 500){ 
				              			alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                        }else if(res.status == 200){ 
                              alertify.set('notifier','position', 'top-right');
                              alertify.set('notifier','delay', 2);
                              alertify.success(res.message); 
                            $('#tblfiles').load(location.href+ " #tblfiles"); 
                            window.onload = timedRefresh(2000);  
                    
                         
                        }
                        }

                        });

                  }  
                  
                 
               });
          });   

         

		  
</script>