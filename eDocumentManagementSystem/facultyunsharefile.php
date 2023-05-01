<?php 
 require 'db_connection.php';
?>
<style> 
.format { 
    font-size:13px;
    font-weight: 500; 
    
}
.format-1{ 
    font-size:12px;
    font-weight: 400;  
    margin-left: 5px; 

}
</style>
<div class="row">
					
<div class="col-3"> 
        <h1 class="h3  "><span><img src="./src/img//photos/documents.png" alt="" style="height:40px;width:40px;"> </span>UNLINK SHARE FILE</h1>
        </div> 
      
        <div class="col-12">
			<div class="card"> 
                <form action="" id="updatesharefile">
            <?php
                
                 
                  $qry = $conn->query("SELECT * FROM tbl_files where id=".$_GET['uqfileid'])->fetch_array();
                  extract($_POST);
                  $fname=$qry['file_path'];
                  $file = ("assets/uploads/".$fname);
                    ?>
			<div class="card-body">   

            
            <input type="hidden" id="fileid" name="fileid" value="<?php echo isset($_GET['uqfileid']) ? $_GET['uqfileid'] :'' ?>">
		    	<div class="col-12  mb-3  border-bottom"> 
                    <span class=" text-muted">FILE DESCRIPTION</span>
                </div> 
                <div class="col-12 mb-1"> 
                    <span class="text-muted format ">File Name:</span> 
                    <span class=" text-muted format-1 " id="filename"><?php  echo $name=$qry['name'].'.'.$qry['file_type']; ?> </span>
                </div>  
                <div class="col-12  mb-1"> 
                    <span class=" text-muted format ">Filetype:</span> 
                    <span class=" text-muted format-1 " id="filetype"><?php  echo $name=$qry['file_type']; ?> </span>
            
                </div> 
                <div class="col-12  mb-1"> 
                    <span class=" text-muted format">Filesize:</span> 
                    <span class=" text-muted format-1 " id="filesize"><?php  echo $name=$qry['filesize']; ?> </span>
            
                </div> 
                <div class="col-12  mb-1"> 
                    <span class="text-muted format">Uploaded:</span>
                    <span class=" text-muted format-1 " id="upload"><?php  echo $name=$qry['date_updated']; ?> </span>
            
                </div>  

                <div class="col-12 mt-4"> 
                <span class=" text-muted">UNLINK FILES:</span>
              
                </div> 
                <!-- <div class="col-12 " > 
              
                <select  id="userlist" class="form-control mt-2  userlist-for-share   mb-3 border-0 " name="userlist[]" multiple="multiple"style="width: 100%; " > 
                                
                           
                </div>  -->
                <div class="col-12 text-start mt-2"> 
                <span><button type="submit"class=" btn btn-danger" id="update_file"><i class="fa-solid fa-xmark mr-1"></i>Unlink</button></span>
              
                </div>  
              	    
             </div>  
             </form> 
				</div>
               
            </div>
				             	</div>             


<script> 
$(document).on('submit','#updatesharefile',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("updatefileshare",true);

        $.ajax({

            type:"POST",
            url:"multishare.php",
            data:formData,
            processData:false,
            contentType:false,

             success:function(response) {
             var res = jQuery.parseJSON(response);

                 if(res.status == 422)
                 {

                    alert(res.message);


                 }
                 else if(res.status==200)
                 {
                   
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    document.getElementById("fileid").value = "";
                $('.js-example-basic-multiple').val(null).trigger('change');
                    setTimeout(()=> { 
                  
                        window.location.href="facultydashboard.php?page=facultysharefile";
   
               // alert(res.message);
                window.localStorage.clear();


                }
                ,2000); 
                    
                   
                 //  $('#successMessage').removeClass('d-none');    
                  // $('#successMessage').text(res.message);    
                //     setTimeout(function(){
                //     $("#successMessage").fadeOut("slow");
                // },3000); 

         


                 


 



                 }
             }
        });

    });

	


</script>