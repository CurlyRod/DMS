
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
        <h1 class="h3  "><span><img src="./src/img//photos/documents.png" alt="" style="height:40px;width:40px;"> </span>SHARE FOLDER</h1>
        </div> 
      
        <div class="col-12">
			<div class="card"> 
                <form action="" id="sharefolder">
            <?php
                  include 'db_connection.php'; 
                 
                  $qry = $conn->query("SELECT * FROM tbl_folders where id=".$_GET['uqfolderid'])->fetch_array();
                  extract($_POST);
                 
                    ?>
			<div class="card-body">   
            <!-- <input type="hidden" id="folderid" name="folderid" value="<?php echo isset($_GET['uqfolderid']) ? $_GET['uqfolderid'] :'' ?>"> -->
		   
            <input type="hidden" id="folderid" name="folderid" value="<?php echo isset($_GET['uqfolderid']) ? $_GET['uqfolderid'] :'' ?>">
		    	<div class="col-12  mb-3  border-bottom"> 
                    <span class=" text-muted">FILE DESCRIPTION</span>
                </div> 
                <div class="col-6 mb-1"> 
                    <span class="text-muted format ">Foldername:</span> 
                    <span class=" text-muted format-1 " id="filename"><?php  echo $name=$qry['foldername']; ?> </span>
                </div>  
               
                <div class="col-6  mb-1"> 
                    <span class="text-muted format">Date Created:</span>
                    <span class=" text-muted format-1 " id="upload"><?php  echo $name=$qry['date_created']; ?> </span>
            
                </div>  
                <div class="form-group green-border-focus col-12 mt-3 d-none">
                <label for="exampleFormControlTextarea5">Message:</label>
                <textarea class="form-control"  name="shareMessage" id="shareMessage" rows="3"><?php  echo $name=$qry['message']; ?></textarea>
                </div> 

                <div class="col-12 mt-4"> 
                <span class=" text-muted">UNLINK FOLDER: </span>
              
                </div> 
                <div class="col-12 " > 
                     <?php  
                             if(isset($_GET['uqfolderid'])) 
                             { 
                             $fileId = $_GET['uqfolderid']; 
         
         
                                 $queryfetch = "SELECT public_to FROM tbl_share_folder WHERE  folder_id = '$fileId' and user_id=".$_SESSION['id']; 
                                 $query_runs = mysqli_query($conn,$queryfetch);
                                 
                                 $user_public_id =[];
         
                                     foreach($query_runs as $fetchuser) 
                                     { 
                                             $user_public_id[] = $fetchuser['public_to'];
                                     }
         
                             }
                             
                         ?>
                    <!-- <select  id="userlist" class="form-control mt-2  userlist-for-share   mb-3 border-0" name="userlist[]" multiple="multiple"style="width: 100%"> 
                                
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



                    </select> -->
                </div>
                <div class="col-12 text-start mt-2"> 
                <span><button type="submit"class=" btn btn-danger" id="update_file"><i class="fa-solid fa-xmark mr-1"></i>Unlink</button></span>
              
                </div>  
              	    
                    
             </div>  
             </form>  
				</div>
                    	</div>
				             	</div>             


<script> 
$(document).on('submit','#sharefolder',function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("unshareFolder",true);

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

                    alertify.set('notifier','position', 'top-right');
                    alertify.error(res.message);


                 }
                 else if(res.status==200)
                 {

                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);
                 
                 //  $('#successMessage').removeClass('d-none');    
                  // $('#successMessage').text(res.message);    
                //     setTimeout(function(){
                //     $("#successMessage").fadeOut("slow");
                // },3000); 
 
                setTimeout(()=> {
                window.location.href="userdashboard.php?page=manage";

                }
                ,2000);
               document.getElementById("folderid").value = "";
                $('.js-example-basic-multiple').val(null).trigger('change');
              
                window.localStorage.clear();




               

                    console.log(res.data);



                 }
             }
        });

    });



</script>