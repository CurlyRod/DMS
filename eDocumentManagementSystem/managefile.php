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
	$imitate_parent = $folder_parent;

$folders = $conn->query("SELECT a.role as type, a.firstname as uname,a.lastname as lname, u.date_shared as dateshared,f.*FROM tbl_folders f inner join tbl_share_folder u on u.user_id = f.user_id  INNER join tbl_users as a ON u.user_id = a.id WHERE u.parent_id = 0 and f.archive = 0 and u.public_to ='".$_SESSION['id']."' and f.id = u.folder_id  and f.parent_id =$imitate_parent  order by date(f.date_created) desc");

//$folders = $conn->query("SELECT a.role as type, a.firstname as uname,a.lastname as lname, u.date_shared as dateshared,f.*FROM tbl_folders f inner join tbl_share_folder u on u.user_id = f.user_id INNER join tbl_users as a ON f.user_id =a.id WHERE  and f.archive = 0 and u.public_to ='".$_SESSION['id']."' and f.id = u.folder_id   GROUP BY f.id order by date(f.date_created) desc");

//    $folders = $conn->query("SELECT a.role as type, a.firstname as uname,a.lastname as lname, u.date_shared as dateshared,f.*FROM tbl_folders f inner join tbl_share_folder u on u.public_to = f.user_id INNER join tbl_users as a ON f.user_id =a.id WHERE f.parent_id = $folder_parent  and f.archive = 0 and u.public_to ='".$_SESSION['id']."' and f.id = u.folder_id   order by date(f.date_created) desc");
// $folders = $conn->query("SELECT a.username as uname,a.lastname as lname,u.user_id,u.date_shared as dateshare ,f.*FROM tbl_folders f inner join tbl_share_folder u on u.user_id = f.user_id and f.id =u.folder_id and f.parent_id = $folder_parent INNER join tbl_users as a ON a.id = u.public_to WHERE  f.archive = 0  and u.public_to = '".$_SESSION['id']."'  order by date(u.date_shared) desc;");

$files = $conn->query("SELECT * FROM tbl_files  where archive= 0 and folder_id = $folder_parent  order by name asc");
 
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
	 	
	 	<div id ="errorMessage"class="alert alert-warning d-none"></div> 
		 <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
			<input type="hidden" name="folder_id" id="folder_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>">
		
	  <div class="row">  
            <div class="col-8"> 
            <input type="file" name="file[]" id="fileInput[]" multiple required>   
            </div> 
            <div class="col-4 d-flex justify-content-end"> 
             
		</div> 
          </div>  
		  <div class="progress mt-3 " >
            <div class="progress-bar  progress-bar-striped""></div>
        </div>
		  <!-- <div class="row mt-4"> 
        
			<label >Description</label>
		  <textarea name="desc" id="desc" cols="35" rows="4"></textarea>
		  
		</div>  -->
		<div class="modal-footer mb-1"> 
		<input class="btn btn-success  text-white"  type="submit" name="submit" value="UPLOAD" />
			<input class="btn btn-secondary  text-white"  type="button" name="btncancel" value="CANCEL" />
            
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

    <div class="col-4"> 
        <h1 class="h4  "><span><img src="./dashboard/images/swap.png" alt="" style="height:40px;width:40px;"> </span>RECEIVED FOLDERS</h1>
        </div> 
      
        <div class="col-8"  >
        	 <div class="col text-end text-dark bg-light   border border-muted shadow-sm mt-3 pr-1 mb-2 bg-body rounded" id="paths">
             <?php 
				$id=$folder_parent;
				while($id > 0){

					$path = $conn->query("SELECT * FROM tbl_folders where id = $id  order by foldername asc")->fetch_array();
					echo '<script>
						$("#paths").prepend("<a href=\"userdashboard.php?page=managefile&fid='.$path['id'].'\">'.$path['foldername'].'</a>/")
					</script>';
					$id = $path['parent_id'];

				}
				echo '<script>
						$("#paths").prepend("Directory: <a href=\"userdashboard.php?page=managefile\">Home</a>/")
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
                 
                <div class="d-flex justify-content-end "> 
                <div class="col-6  input-group ">
		
        <input type="text" class="form-control bg-transparent rounded" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >
        <div class="input-group-append">
              <span class="input-group-text bg-transparent border-0"  id="inputGroup-sizing-sm"><img src="./dashboard/images/search.png "style="height:25px;width:30px;" alt=""></span>
        </div>
                           
                </div>
							
                           </div>
                
            </div> 
            
								<div class="card-body" id="cardFolder"> 
                        <div class="row col-12 mb-2 ml-1" style="overflow: scroll; height:180px; ">
                        <?php 
                            while($row=$folders->fetch_assoc()):
                            ?>
                                <div class="card text-center col-md-3 p-1  folder-item  " id="cardfiles" data-id="<?php echo $row['id'] ?>" style="box-shadow:none;">
                                    <div class="card-body">
                                            <large><img src="./img/photos/yellow.png" style="height:95px; width:100x;"> <p class="to_folder  " style="font-size:14px; ">[<?php echo $row['type']?>~<?php echo $row['uname'].' '.$row['lname'] ?>]
											<b class="text-primary"><?php echo $row['foldername'] ?></b> </p></large>
                                            
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
									
										
									<!-- <li><a class="dropdown-item"><button value='<?php echo $row['id']?>' class="deleteUser btn" ><img src="./dashboard/images/delete.png" style="width:20px;heigth:20px;"> Delete</button> </a></li> -->
								
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

<!-- <a href="javascript:void(0)" class="custom-menu-list file-option edit"><span><i class="fa fa-edit" style="color:#53A7F3;margin-right:5px;"></i> </span> Rename</a>
<a href="javascript:void(0)" class="custom-menu-list file-option delete"> <span><i class="fa fa-trash" style="color:red;"></i> </span>Delete</a>-->

<a href="" class="custom-menu-list file-option delete" id="unlinkFolder"><span><i class="fa-solid fa-link mr-2 text-danger"></i></span>Unlink</a> 
</div>
<div id="menu-file-clone" style="display: none;">

<!-- <a href="javascript:void(0)" class="custom-menu-list file-option viewfiles"><span><i class="fa-solid fa-eye"></i> </span>View Files</a> 
<a href="javascript:void(0)" class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span>Rename</a>
<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
<a href="javascript:void(0)" class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span>Delete</a> -->

</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="./src/alertify/alertify.min.js" type="text/javascript"></script>
           <script>



function timedRefresh(timeoutPeriod) {
    setTimeout("location.reload(true);",timeoutPeriod);   
      }

$('.folder-item').click(function(){
location.href = 'userdashboard.php?page=managefile&fid='+$(this).attr('data-id')
})     
$('#addfolders').click(function(){ 
	 var folder  = <?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>  
	//  localStorage.setItem("getvalue",folder);
	location.href = 'userdashboard.php?page=fileupload&fid='+folder;

}) 
$(document).on('click','#unlinkFolder',function(){ 
		 
		 var flderid = $(this).attr("data-id");
		 location.href=('userdashboard.php?page=userunsharefolder&uqfolderid='+flderid );
	  
		  });
$('.downloadFile').click(function(){ 
	var user_id = $(this).val();
    // alert(user_id );  
	 location.href = 'download.php?id='+user_id;
	
}); 
$('.viewFile').click(function(){ 
	var file_id = $(this).val(); 
	
	
	//  localStorage.setItem("getvalue",folder);
	location.href = 'userdashboard.php?page=readfiles&fileid='+ file_id;

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

$("div.custom-menu .edit").click(function(e){
e.preventDefault()
uni_modal('Rename Folder','manage_folder.php?fid=<?php echo $folder_parent ?>&id='+$(this).attr('data-id') )
})
$("div.custom-menu .delete").click(function(e){
e.preventDefault()
_conf("Are you sure to delete this Folder?",'delete_folder',[$(this).attr('data-id')])
})
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

$("div.file.custom-menu .edit").click(function(e){
e.preventDefault()
$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').siblings('large').hide();
$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').show();
})
$("div.file.custom-menu .delete").click(function(e){
e.preventDefault()
_conf("Are you sure to delete this file?",'delete_file',[$(this).attr('data-id')])
})
$("div.file.custom-menu .download").click(function(e){
e.preventDefault()
window.open('download.php?id='+$(this).attr('data-id'))
})
$("div.file.custom-menu .viewfiles").click(function(e){
  e.preventDefault()

  window.open('view_document.php?id='+$(this).attr('data-id')) 

})
 


 

$('.rename_file').keypress(function(e){
var _this = $(this)
if(e.which == 13){
	start_load()
	$.ajax({
		url:'ajax.php?action=file_rename',
		method:'POST',
		data:{id:$(this).attr('data-id'),name:$(this).val(),type:$(this).attr('data-type'),folder_id:'<?php echo $folder_parent ?>'},
		success:function(resp){
			if(typeof resp != undefined){
				resp = JSON.parse(resp);
				if(resp.status== 1){
						_this.siblings('large').find('b').html(resp.new_name);
						end_load();
						_this.hide()
						_this.siblings('large').show()
				}
			}
		}
	})
}
})

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
	// $('.to_file').each(function(){
	// 	var val  = $(this).text().toLowerCase()
	// 	if(val.includes(_f))
	// 		$(this).closest('tr').toggle(true);
	// 		else
	// 		$(this).closest('tr').toggle(false);

		
	// })
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
            url: 'savefile.php',
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

			if(res.status == 422) 
			{  
				$('#errorMessage').removeClass('d-none');   
				$('#errorMessage').text(res.message); 
				console.log();  
			}else if(res.status == 200)
			{ 	
				//$('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>').fadeOut(7000);;
                $(".progress-bar").fadeOut(7000);
					
				alertify.set('notifier','position', 'top-right');
				alertify.success(res.message);  
				
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



    // File type validation
    $("#fileInput").change(function(){
        var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif','video/mp4'];
        var file = this.files[0];
        var fileType = file.type;
        if(!allowedTypes.includes(fileType)){
            alert('Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).');
            $("#fileInput").val('');
            return false;
        }
    });




	$(document).on('click','.shareFile',function(){ 
		
	});
</script>