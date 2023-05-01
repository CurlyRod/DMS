
<div class="row">  
    
    <div class="col-8 d-flex justify-content-start"> 
    <h1 class="h3  "><span><img src="./img/sidebar/paper.png" alt="" style="height:40px;width:40px;"> </span> TOTAL FOLDERS</h1>
    <style>  
        #adduser:hover{ 
        cursor: pointer;  
        border:0;
        transition: transform .1s;   
        transform: scale(1.2);  
        
        }
    </style>
    </div>  
    
    <div class="col-4 d-flex justify-content-center d-none"> 
    <h6 class="h6"><span><img src="./img/sidebar/user copy.png" id="adduser" alt="" style="height:40px;width:40px;"data-bs-toggle="modal" data-bs-target="#addUserModal">Add user</h6>
    
    </div>
    
    <!-- ADD USER MODAL-->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content ">
          <div class="modal-header p-2">
      <img src="./dashboard/images/gangster.png" style="height:40px;weight:40px;"> <h6 class="modal-title  text-center mt-3 ml-2" id="exampleModalLabel">Add User</h6>  
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div> 
    
          <div class="modal-body"> 
     
            <div id ="errorMessage"class="alert alert-warning d-none"></div> 
            
                  <form id="saveuser"> 
                  <div class="row"> 
                  <div class="col-4">
                  <label  class="form-label" >First Name:</label>
                  <input type="text" class="form-control" name="firstName" id="firstName"> 
                
              </div>  
              <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Middle Name:</label>
                  <input type="text" class="form-control" name="middleName" id="middleName">
              </div> 
              <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Last Name:</label>
                  <input type="text" class="form-control" name="lastName" id="lastName">
              </div>
              <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Username:</label>
                  <input type="text" class="form-control" name="username" id="username">
              </div> 
              <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password"></div>
              <!-- <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Re-type Password:</label>
                <input type="password" class="form-control" name="confirmpass"id="confirmpass"></div>
               -->
    
                <div class="col-4">
                <label for="type">User Type</label>
                <select name="role" id="role" class="custom-select">
                  <option value="Admin" <?php echo isset($meta['type']) && $meta['type'] == 'Admin' ? 'selected': '' ?>>Admin</option>
                  <option value="Faculty" <?php echo isset($meta['type']) && $meta['type'] == 'Faculty' ? 'selected': '' ?>>Faculty</option>
                  <option value="User" <?php echo isset($meta['type']) && $meta['type'] == 'User' ? 'selected': '' ?>>User</option>
                  
                </select>
                </div> 
                 
             
              
              <div class="col-4">
              <label for="type">Status</label>
                  <select name="status" id="status" class="custom-select">
                    <option value="Active" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Active</option>
                    <option value="Disable" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Disable</option>
                </select>
                </div>   
    
                <div class="col-4 invisible">
                  <label for="type">Archive</label>
                <select name="archive" id="archive" class="custom-select">
                    <option value="Active" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Active</option>
                    <option value="Disable" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Disable</option>
                </select>
                </div>   
    
              </div>
              
      
    
    
      
              <div class="modal-footer"> 
            <button type="button" class="btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn-sm btn-success">Save</button>
          </div>
          </div>
      </form>
          
         
        </div>
      </div>
    </div> 
    <!-- END USER MODAL-->  
    <!-- EDIT USER MODAL--> 
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content ">
          <div class="modal-header p-2">
      <img src="./img/sidebar/information.png" style="height:40px;weight:40px;"> <h6 class="modal-title  text-center mt-3 ml-2" id="exampleModalLabel">Edit User</h6>  
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div> 
    
          <div class="modal-body"> 
     
            <div id="errorMessageUpdate" class="alert alert-warning d-none"></div> 
            
                  <form id="updateuser">  
    
                  <div class="row">  
                    <input type="hidden" name="user_id" id="user_id"> 
    
                  <div class="col-4">
                  <label  class="form-label" >First Name:</label>
                  <input type="text" class="form-control" name="firstName" id="editFirstname"> 
                
              </div>  
              <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Middle Name:</label>
                  <input type="text" class="form-control" name="middleName" id="editMiddlename">
              </div> 
              <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Last Name:</label>
                  <input type="text" class="form-control" name="lastName" id="editLastname">
              </div>
              <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Username:</label>
                  <input type="text" class="form-control" name="username" id="editUsername">
              </div> 
              <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Password:</label>
                <input type="password" class="form-control" name ="password"id="editpassword"></div>
              
                <!-- <div class="col-4">
                  <label for="exampleInputEmail1" class="form-label">Re-type Password:</label>
                <input type="password" class="form-control" id="editconfirmpass"></div>
               -->
     
                <div class="col-4">
                <label for="type">User Type</label>
                <select name="editrole" id="editrole" class="custom-select">
                  <option value="Admin" <?php echo isset($meta['type']) && $meta['type'] == "Admin" ? 'selected': '' ?>>Admin</option>
                  <option value="Faculty" <?php echo isset($meta['type']) && $meta['type'] ==  "Faculty"? 'selected': '' ?>>Faculty</option>
          
                  <option value="User" <?php echo isset($meta['type']) && $meta['type'] ==  "User"? 'selected': '' ?>>User</option>
               
                </select>
                </div> 
                 
    
            
              
                <div class="col-4">
                <label for="type">Status</label>
                <select name="editstatus" id="editstatus" class="custom-select">
                  <option value="Active" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Active</option>
                  <option value="Disable" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Disable</option>
                </select>
                </div> 
                 
              <div class="col-4 invisible">
                <label for="type">Status</label>
                    <select name="uparchive" id="uparchive" class="custom-select">
                      <option value="Active">Active</option>
                      <option value="Disable">Disable</option>
                    </select>
                </div>   
    
              </div>
              
              <div class="modal-footer"> 
            <button type="button" class="btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn-sm btn-success">Save changes</button>
          </div>
          </div>
          </form>
          
         
        </div>
      </div>
    </div>   
    <!-- END EDIT USER MODAL-->  
    
    <!-- START VIEW USER MODAL -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content "> 
    
              <div class="modal-header p-2">
              <img src="./assets/img/profile.png" style="height:40px;weight:40px;"> <h6 class="modal-title  text-center mt-3 ml-2" id="exampleModalLabel">Edit User</h6>  
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div> 
    
          <div class="modal-body"> 
    
          <div class="row ">  
                    <!-- <input type="hidden" name="user_id" id="user_id">  -->
    
              <div class="col-4">
                      <label for="viewFirstname" class="form-label  m-0 fst-italic  " >First Name:</label>
                      <p id="viewFirstname" class="border rounded  m-0 pl-1"></p> 
                      <!-- <p style="margin: 0; display: inline; font-size:13px ">Firstname:</p>
                      <p style="margin: 0; display: inline;" id="viewFirstname"align="left"></p> 
                       --> 
                      
              </div>  
              <div class="col-4" >
                      <label class="form-label m-0 fst-italic">Middle Name:</label>
                      <p id="viewMiddlename" class="border  rounded  m-0 pl-1"></p> 
    
                      
                </div> 
              <div class="col-4">
                     <label for="viewFirstname" class="form-label m-0 fst-italic " >Last Name:</label>
                      <p id="viewLastname" class="border rounded m-0 pl-1"></p> 
              </div>  
    
              <div class="col-4">
                      <label for="exampleInputEmail1" class="form-label mt-2 mb-0 fst-italic ">Username:</label>
                      <p class="border rounded m-0 pl-1" id="viewUsername"></p>
              </div> 
              <div class="col-4">
                     <label for="exampleInputEmail1" class="form-label mt-2 mb-0 fst-italic ">Password:</label>
                      <p class="border rounded  m-0 pl-1 " id="viewPassword"></p>
            </div>  
    
             
           
            <div class="col-4">
                     <label for="exampleInputEmail1" class="form-label mt-2 mb-0 fst-italic ">User Type:</label>
                      <p class="border rounded  m-0 pl-1 " id="viewrole"></p>
            </div>  
             
            <div class="col-4">
                     <label for="exampleInputEmail1" class="form-label mt-2 mb-0 fst-italic ">Status:</label>
                      <p class="border rounded  m-0 pl-1 " id="viewstatus"></p>
            </div>   
    
    
    
    
            </div>
              <div class="modal-footer"> 
            <button type="button" class="btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
            <!-- <button type="submit" class="btn-sm btn-success">Save changes</button> -->
           
    </div>
    </div> 
    
        </div>
      </div>
    </div>   
    
    <!-- END VIEW USER MODAL -->
     
    
    
        
    
                        <div class="row"> 
                
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                        <div class="col-2 d-flex justify-content-end "> 
                <!-- <h5 class=" mt-2">Filter by:</h5>
                        </div>
                      <div class="col-10 d-flex justify-content-start"> 
    <select name="role" id="role" class="col-10 js-example-basic-single" >
                  <option value="Admin" <?php echo isset($meta['type']) && $meta['type'] == 'Admin' ? 'selected': '' ?>>Admin</option>
                  <option value="User" <?php echo isset($meta['type']) && $meta['type'] == 'User' ? 'selected': '' ?>>User</option>
                </select>
    </div> -->
                   
                                    </div> 
                    </div>
                                    <div class="card-body">  
    
                                    <div class="table-responsive "> 
                          <table
                          id="tblUsers"
                          class="table table-row-border data-table table-hover "
                        
                         >  
                   
                        <thead style="background:#83C9FF;" >
                          <tr class="  fw-bold text-dark" > 
                                <th  class="text-center fw-normal  ">#</th> 
                                <!-- <td><input type="checkbox"></td> -->
                            
                                   <th  class="text-center fw-normal ">Role</th>
                                <th  class="text-center fw-normal">Firstname</th>  
                                <th  class="text-center fw-normal">Lastname</th>
                                <th  class="text-center fw-normal">Foldername</th>  
                                <th  class="text-center fw-normal">Date Deleted</th>  
                          
    </thead>
    
    <tbody>
    
    <?php
                               require 'db_connection.php';
    
                         $users = $conn->query("SELECT u.role as role ,u.firstname as firstname,u.lastname as lastname,f.foldername as foldername,f.date_modify as date_created from tbl_users as u INNER join tbl_folders as f on u.id = f.user_id  WHERE f.archive = 1");
                          
                        
                        $i = 1; 
                  //     $type = array('',"Admin","User"); 
                      //  $status = array('',"Active","Disabled");
                         while($row= $users->fetch_assoc()):
                     ?>
                     <tr >  
                     <td   class="text-center">
                             <b><?php echo $i++ ?></b>
                         </td>  
                        <!-- <td> <input type="checkbox"> </td> -->
    
    
                         <td  class="text-center" >
                             <?php echo $row['role'] ?>
                         </td>  
    
                         <td class="text-center" >
                             <?php echo $row['firstname'] ?>
                         </td >  
    
               <td class="text-center" >
                             <?php echo $row['lastname'] ?>
                         </td > 
               <td class="text-center" >
                             <?php echo $row['foldername'] ?>  
              </td>
                 <td class="text-center" >
                             <?php echo $row['date_created'] ?>
                         </td >  
              
                     
                      <!-- <td class="text-center"><?php echo $type[$row['role']] ?></td> -->
                      
                     </tr>
                    <?php endwhile; ?>
                </tbody>
    
             </table>
                        </div>
           
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <script src="./src/alertify/alertify.min.js" type="text/javascript"></script>
    
                        <script>  
    $(document).ready(function () {
        $('#tblUsers').DataTable();
    });  
    
    function timedRefresh(timeoutPeriod) {
        setTimeout("location.reload(true);",timeoutPeriod);   
          }  
          
          $(document).on('submit' , '#saveuser',function(e){  
                e.preventDefault(); 
                
                var formData = new FormData(this);  
                formData.append("save_user" ,true);
                
                $.ajax({  
                  type:"POST", 
                  url: "saveuser.php",
                  data:formData, 
                  processData:false, 
                  contentType:false,
                    success:function(response) {   
    
                      var res = jQuery.parseJSON(response);
    
                      if(res.status == 422) 
                      {  
                            $('#errorMessage').removeClass('d-none');   
                            $('#errorMessage').text(res.message);  
                      }else if(res.status == 200)
                      { 
                            $('#errorMessage').addClass('d-none');   
                            $('#addUserModal').modal('hide'); 
                            
                            alertify.set('notifier','position', 'top-right'); 
                                 alertify.set('notifier','delay',1);
                                alertify.success(res.message);
                            // alertCustomize() ;
                            // $('.msg').text(res.message);  
    
                            window.onload = timedRefresh(1000); 
                            $('#saveuser')[0].reset();  
                          //  $(".modal-backdrop").hide(); 
                             
                          $('#tblUsers').load(location.href+ " #tblUsers"); 
                            
                          
                             
                     
                                        
    
                          } 
                    }
                });
    
    
    
              }); 
     
    
    
          
              $(document).on('click','.editUser',function()
              { 
                
                var user_id = $(this).val();
              // alert(user_id );
                $.ajax({  
    
                    type:"GET",
                    url:"saveuser.php?user_id="+user_id,
                    success: function(response){ 
                      var res = jQuery.parseJSON(response);
                      if(res.status == 422){ 
                          alert(res.message);
                      }else if(res.status == 200)
                      { 
                            $('#user_id').val(res.data.id);  
    
                            $('#editUsername').val(res.data.username);
                            $('#editFirstname').val(res.data.firstname);
                            $('#editMiddlename').val(res.data.middlename);
                            $('#editLastname').val(res.data.lastname);
                            $('#editpassword').val(res.data.password); 
                            $('#editconfirmpass').val(res.data.password);
                            $('#editrole').val(res.data.role); 
    
                            $('#editstatus').val(res.data.status); 
                            $('#editarchive').val(res.data.archive);
    
    
                            $('#editUserModal').modal('show'); 
                            
                      }
                    }
    
                });
    
              }); 
    
    
              $(document).on('submit','#updateuser',function(e){  
                e.preventDefault(); 
                
                var formData = new FormData(this);  
                formData.append("update_user" ,true);
                
                $.ajax({ 
                  type:"POST", 
                  url: "saveuser.php",
                  data:formData, 
                  processData:false, 
                  contentType:false,
                    success:function(response) {   
    
                      var res = jQuery.parseJSON(response);
    
                      if(res.status == 422) 
                      {  
                            $('#errorMessageUpdate').removeClass('d-none');   
                            $('#errorMessageUpdate').text(res.message);  
                      }else if(res.status == 200)
                      { 
                            $('#errorMessageUpdate').addClass('d-none');   
                            $('#editUserModal').modal('hide'); 
                            $('#updateuser')[0].reset(); 
                              
    
    
                                // alertCustomize() ;
                                // $('.msg').text(res.message);  
                                 alertify.set('notifier','position', 'top-right'); 
                                 alertify.set('notifier','delay',1);
                                alertify.success(res.message);
     
    
    
                              $('#tblUsers').load(location.href+ " #tblUsers");
                                       window.onload = timedRefresh(1000); 
                          } 
                    }
                });
    
    
    
              });  
    
              $(document).on('click','.viewUser',function()
              { 
                
                var user_id = $(this).val();
              // alert(user_id );
                $.ajax({  
    
                    type:"GET",
                    url:"saveuser.php?user_id="+user_id,
                    success: function(response){ 
                      var res = jQuery.parseJSON(response);
                      if(res.status == 422){ 
                          alert(res.message);
                      }else if(res.status == 200)
                      { 
                            // $('#user_id').val(res.data.id);  
    
                            $('#viewUsername').text(res.data.username);
                            $('#viewFirstname').text(res.data.firstname);
                            $('#viewMiddlename').text(res.data.middlename);
                            $('#viewLastname').text(res.data.lastname);
                            $('#viewPassword').text(res.data.password); 
                            // $('#viewconfirmpass').val(res.data.password);
                            $('#viewrole').text(res.data.role); 
    
                            $('#viewstatus').text(res.data.status); 
                            // $('#viewarchive').val(res.data.archive);
    
    
                            $('#viewUserModal').modal('show'); 
                            
                      }
                    }
    
                });
    
              }); 
              $(document).on('click','.deleteUser',function(e){   
                  e.preventDefault();
    
    
                  Swal.fire({
                      title: 'Are you sure to delete this data?',
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
                            url: "saveuser.php",
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
                                  alertify.success(res.message);
                          //    alertCustomize() ;
                          //  $('.msg').text(res.message);  
                          $('#tblUsers').load(location.href+ " #tblUsers");
                                       window.onload = timedRefresh(1000);   
    
                             
                            }
                            }
    
                            });
    
                      }  
                      
                     
                   });
              });  
                                        
      $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
                                        
                             
    
    </script>