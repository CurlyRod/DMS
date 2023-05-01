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
        <h3 class="h4  "><span><img src="./src/img//photos/documents.png" alt="" style="height:40px;width:40px;"> </span>UPDATE SHARE FILE</h3>
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
                <?php  
                 if(isset($_GET['uqfileid'])) 
                 { 
                 $fileId = $_GET['uqfileid']; 


                     $queryfetch = "SELECT * FROM tbl_share WHERE  file_id = '$fileId' and user_id='".$_SESSION['id']."' GROUP BY date_upload HAVING message = message" ; 
                     $query_runs = mysqli_query($conn,$queryfetch);
                     
                     $user_public_id =[];

                         foreach($query_runs as $fetchuser) 
                         { 
                                 $user_public_id[] = $fetchuser['public_to'];
                         }

                 }
                


                  $id_array = $user_public_id;
                  $id_list = implode(',', $id_array);
               $sql = ("SELECT * FROM tbl_share   WHERE  public_to IN($id_list)  and user_id='".$_SESSION['id']."' and file_id ='".$_GET['uqfileid']."' GROUP BY date_upload HAVING  message = message" );
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
               $value = $row['message'];
                ?>
                <div class="form-group green-border-focus col-12 mt-3 d-none">
                <label for="exampleFormControlTextarea5">Message:</label>
                <textarea class="form-control"  name="shareMessage" id="shareMessage" rows="3"><?php echo $value ?></textarea>
                </div>  
                <div class="col-12 text-start mt-2"> 
                <span><button type="button"class=" btn btn-info d-none" id="update_message"><i class="fa-solid fa-pen mr-1"></i>Update</button></span>
              
                </div>  

                <div class="col-12 mt-3"> 
                <span class=" text-muted">UNSHARE TO USER:</span>
              
                </div> 
                <div class="col-12 " > 
                     <?php  
                             if(isset($_GET['uqfileid'])) 
                             { 
                             $fileId = $_GET['uqfileid']; 
         
         
                                 $queryfetch = "SELECT public_to FROM tbl_share WHERE  file_id = '$fileId' and user_id=".$_SESSION['id']; 
                                 $query_runs = mysqli_query($conn,$queryfetch);
                                 
                                 $user_public_id =[];
         
                                     foreach($query_runs as $fetchuser) 
                                     { 
                                             $user_public_id[] = $fetchuser['public_to'];
                                     }
         
                             }
                             
                         ?>
                    <select  id="userlist" class="form-control mt-2  userlist-for-share   mb-3 border-0" name="userlist[]" multiple="multiple"style="width: 100%"> 
                                
                            <?php
                       $id_array = $user_public_id;
                       $id_list = implode(',', $id_array);
                        $query = "SELECT * FROM tbl_users where role !='Admin' and id IN($id_list)and id <> ".$_SESSION['id'] ; 
                          $query_run = mysqli_query($conn,$query);


                            if(mysqli_num_rows($query_run) > 0)
                            {

                                foreach($query_run as $row){
                                ?>
                                <option value="<?=$row['id'];?>" 
                                  <?=  in_array($row['id'],$user_public_id) ? 'selected':''  ?>
                                >  
                                
                               <?= $row['role'];?> ~ <?=$row['firstname'];?> <?=$row['lastname'];?>  </option>
                                  

                                <?php
                                }
                            }
                            else{
                                ?>
                                <option value="">NO Record FOUND!</option>
                               <?php
                               }
                     ?>



                    </select>
                </div> 
                <div class="col-12 text-end mt-2"> 
                <span><button type="submit"class=" btn btn-success" id="update_file"><i class="fa-solid fa-share mr-1"></i>Update</button></span>
              
                </div>  
              	    
             </div>  
             </form> 
				</div>
               
            </div>
				             	</div>             


<script> 
$(document).on('click','#update_message',function(){
         var data = new FormData();
        // var formData = new FormData(this);
        // formData.append("updatefileshare",true);
        var flder_id = document.querySelector("#shareMessage");  
        var file_id = document.querySelector("#fileid"); 
        var fid= file_id.value;   

        var value = flder_id.value;   
        data.append('file_id',fid);
        data.append('value',value);
        $.ajax({

            type:"POST",
            url:"multishare.php",
            data:data,
            processData:false,
            contentType:false,

             success:function(response) {
             var res = jQuery.parseJSON(response);

                 if(res.status == 500)                 {

                    alert(res.message);


                 }
                 else if(res.status==200)
                 {
                   
                    alertify.set('notifier','position', 'top-right');
                           alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

         
                    setTimeout(()=> { 
               // alert(res.message);
               location.reload();


                }
                ,1000); 
                    
                   
                 //  $('#successMessage').removeClass('d-none');    
                  // $('#successMessage').text(res.message);    
                //     setTimeout(function(){
                //     $("#successMessage").fadeOut("slow");
                // },3000); 

         


                 


 



                 }
             }
        });

    });
    $(document).on('submit','#updatesharefile',function(e){  
            e.preventDefault(); 
            
            var formData = new FormData(this);  
            formData.append("updatefileshare" ,true);
            
            $.ajax({ 
              type:"POST", 
              url: "multishare.php",
              data:formData, 
              processData:false, 
              contentType:false,
                success:function(response) {   

                  var res = jQuery.parseJSON(response);

                  if(res.status == 422) 
                  {  
                    alertify.set('notifier','position', 'top-right'); 
                    alertify.set('notifier','delay',1);
                    alertify.success(res.message);
                  }else if(res.status == 200)
                  { 
                        
                       alertify.set('notifier','position', 'top-right'); 
                       alertify.set('notifier','delay',1);
                       alertify.success(res.message);
                     
                       setTimeout(()=> {
                window.location.href="userdashboard.php?page=usersharefile";

                }
                ,1000);
                          


 


                        
   				               
                      } 
                }
            });



          });  

	


</script>