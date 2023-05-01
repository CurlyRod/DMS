<h1 class="h3 mb-3">ARCHIVE USER</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									
								</div>
								<div class="card-body"> 
								<div class="table-responsive"> 
                    <table
                    id="tblRestore"
                    class="table table-row-border data-table table-hover "
                    style="width: 100%"
                  > 
                  <thead >
                      <tr class="table-info text-dark">
                    
							<th  class="text-center fw-normal ">#</th>
							<th  class="text-center fw-normal">FirstName</th>
							<th  class="text-center fw-normal">MiddleName</th>  
                            <th  class="text-center fw-normal">LastName</th> 
                            <th  class="text-center fw-normal">Username</th> 
                            <th  class="text-center fw-normal">UserType</th> 
                            <!-- <th  class="text-center fw-normal">Status</th>   -->
							<th  class="text-center fw-normal"></th> 
           
                      </tr>
                    </thead>  
                    <tbody > 

                    <?php
 					      require 'db_connection.php';

 					$users = $conn->query("SELECT * FROM tbl_users WHERE archive = 'Disable'  order by firstname   asc");
 					 
					
					$i = 1; 
              //     $type = array('',"Admin","User"); 
                  //  $status = array('',"Active","Disabled");
 					while($row= $users->fetch_assoc()):
				 ?> 

                    <tr >
				 	<td   class="text-center">
				 		<b><?php echo $i++ ?></b>
				 	</td> 

				 	<td  class="text-center">	<?php echo $row['firstname'] ?>	</td>  
				 	<td class="text-center"><?php echo $row['middlename'] ?> </td >  
           <td class="text-center"> <?php echo $row['lastname'] ?>  </td > 
           <td class="text-center">  <?php echo $row['username'] ?>   </td>
                         
           

           <td class="text-center text-success">		<?php echo $row['role'] ?>  </td>
          <!-- <td class="text-center text-success">		<?php echo $row['status'] ?>  </td> -->
 
<td>
          <center>
                <div class="dropdown">
                  <button class="btn  " type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                  <img src="./dashboard/images/down.png" alt="" style="height:20px;width:20px;">
                  </button>
                  <ul class="dropdown-menu"> 
                
                    <li><a class="dropdown-item"><button value='<?php echo $row['id']?>' class="restoreUser btn" ><img src="./dashboard/images/backup-file.png" style="width:25px;heigth:25px;">Restore</button> </a></li>
					<li><a class="dropdown-item"><button value='<?php echo $row['id']?>' class="deleteUser btn" ><img src="./dashboard/images/delete.png" style="width:20px;heigth:20px;">Delete</button> </a></li>
                
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
	       $(document).ready(function () {
    $('#tblRestore').DataTable();
});  

					$(document).on('click','.restoreUser ',function(e){   
              e.preventDefault();


              Swal.fire({
                  title: 'Are you sure to Restore this account?',
                  icon: 'warning', 
                  width:'500px' ,  
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
                
                
               }).then((result) => {
                  if (result['isConfirmed']){
                     // Put your function here
                     
                     var user_id =$(this).val(); 


                        $.ajax({ 

                        type:"POST", 
                        url: "archivemodule/adminrestore.php",
                        data:{ 
                        'restore_user':true,  
                        'user_id':user_id
                        }, 
                        success: function(response){  
                        var res = jQuery.parseJSON(response);
                        if(res.status == 500){  
                          alert(res.message);
                           
                        }else{ 
                              // alertify.set('notifier','position', 'top-right');
                              //   alertify.success(res.message);
                      alertCustomize() ;
                       $('.msg').text(res.message);  
        
                          $('#tblRestore').load(location.href+ " #tblRestore"); 
                          window.onload = timedRefresh(2000); 
                        }
                        }

                        });




                  }  
                  
                 
               });
            
                  

     });  


     $(document).on('click','.deleteUser ',function(e){   
              e.preventDefault();


              Swal.fire({
                  title: 'Are you sure to Delete this account?',
                  icon: 'warning', 
                  width:'500px' ,  
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
                
                
               }).then((result) => {
                  if (result['isConfirmed']){
                     // Put your function here
                     
                     var user_id =$(this).val(); 


                        $.ajax({ 

                        type:"POST", 
                        url: "archivemodule/restoreaccount.php",
                        data:{ 
                        'delete_user':true,  
                        'user_id':user_id
                        }, 
                        success: function(response){  
                        var res = jQuery.parseJSON(response);
                        if(res.status == 500){ 
                            alert(res.message);

                        }else{ 
                              alertify.set('notifier','position', 'top-right');
                              alertify.set('notifier','delay',3);
                                alertify.success(res.message);
                     // alertCustomize() ;
                     //   $('.msg').text(res.message);  
        
                          $('#tblRestore').load(location.href+ " #tblRestore");
                        }
                        }

                        });




                  }  
                  
                 
               });
            
                  

     });  
        
        


</script>