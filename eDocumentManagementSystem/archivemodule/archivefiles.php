 
 <!-- <style> 
table td{
	border-left:1px solid black;
}</style> -->
<h1 class="h3  "><span><img src="./img/sidebar/totalfile.png" alt="" style="height:40px;width:40px;"> </span>ARCHIVE FILES</h1>
     
     <?php include('db_connection.php') ;
        $files = $conn->query("SELECT f.*,u.firstname as uname, u.lastname as lname   FROM tbl_files  f inner join tbl_users u on u.id = f.user_id where f.archive = 3 order by date(f.date_updated) desc;");
    
        $days = 25;
        $date = date('Y-m-d', strtotime("-$days days"));
        $query = "SELECT * FROM tbl_files WHERE archive  = 3 and date_updated > '$date' and user_id=".$_SESSION['id']; 

        $result = $conn->query($query); 

        while ($row = $result->fetch_assoc()) {
          
          if($days==0)
          {
           $deleteion =   unlink($row['local_path']);  
           $query = "DELETE FROM tbl_files WHERE archive  =  3 and date_updated >'$date";  
           $execute = mysqli_query($conn,$query); 
           $fileName = $row['name'].'.'.$row['file_type'];   
          
           $delete = 'Automatically Deleted file' ;
           $action ='Deletion of files' ;
           $user =  $_SESSION['id'];
           
           $querys = "INSERT INTO tbl_reports(description,action,user_id,name)VALUES('$delete','$action','$user','$fileName')";
           $executes = mysqli_query($conn,$querys);
         
         } 
          
          } 
         
        ?> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                    
                                    </div>
                                    <div class="card-body"> 
                                   <div class="table-responsive">
                      <table
                        id="tblfiles"
                        class="table table-row-border data-table table-hover  "
                        style="width: 100%"
                      >
                        <thead >
                          <tr class="table text-black  " style="background:#83C9FF;">
                        
                          <th class="text-center fw-normal " >Uploader</th>
                                <th class="text-center fw-normal " >Filename</th>
                                <th  class="text-center fw-normal " >Extension</th>
                                <th  class="text-center fw-normal " >Size</th>  
                                <th  class="text-center fw-normal ">Duration</th>
                               
                                <th  class="text-center fw-normal ">Date Deleted</th>
                                
                                <th class="text-center fw-normal"></th>
                          </tr>
                        </thead> 
    
                        <tbody class="">
                        <?php 
                        while($row=$files->fetch_assoc()):
                            $name = explode(' ||',$row['name']);
                            $name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type'] : $name[0] .".".$row['file_type'];
                            $img_arr = array('png','jpg','jpeg','gif','psd','tif');
                            $doc_arr =array('doc','docx');
                            $pdf_arr =array('pdf','ps','eps','prn');
                            $icon ='fa-file fa-lg text-secondary';
                            if(in_array(strtolower($row['file_type']),$img_arr))
                                $icon ='fa-file-image fa-lg text-info';
                            if(in_array(strtolower($row['file_type']),$doc_arr))
                                $icon ='fa-file-word fa-lg text-info';
                            if(in_array(strtolower($row['file_type']),$pdf_arr))
                                $icon ='fa-file-pdf fa-lg text-danger';
                            if(in_array(strtolower($row['file_type']),['xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr']))
                                $icon ='fa-file-excel fa-lg text-success';
                            if(in_array(strtolower($row['file_type']),['zip','rar','tar']))
                                $icon ='fa-file-archive fa-lg text-warning'; 
                            if(in_array(strtolower($row['file_type']),['mp4','mov','avi','flv','avchd','swf']))
                                $icon ='fa-file-video fa-lg text-primary';
    
    
    
                        ?>
                            <tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">

                            <td class="text-center"><i><?php echo ucwords($row['uname'].' '.$row['lname']) ?></i></td>
                                <td class="text-justify"><large><span><i class="fa <?php echo $icon ?>"></i></span><b> <?php echo $name ?></b></large>
                                <input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
    
                                </td>
                                <td  class="text-center"><i class="to_file"><?php echo $row['file_type'] ?></i></td>
                                 <td  class="text-center"><i class="to_file"><?php echo $row['filesize'] ?></i></td>
                                 <td  class="text-center"><i class="to_file"><?php echo $days  .' days' ?></i></td>
                              
                                 <td   class="text-center" ><i><?php echo date('Y/m/d h:i A',strtotime($row['date_updated'])) ?></i></td>
                            
                                 <td>
          <center>
                <div class="dropdown">
                  <button class="btn  " type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                  <img src="./dashboard/images/down.png" alt="" style="height:20px;width:20px;">
                  </button>
                  <ul class="dropdown-menu"> 
                
                    <li><a class="dropdown-item"><button value='<?php echo $row['id']?>' class="restoreFile btn" ><img src="./dashboard/images/backup-file.png" style="width:25px;heigth:25px;">Restore</button> </a></li>
					<li><a class="dropdown-item"><button value='<?php echo $row['id']?>' class="deleteFile btn" ><img src="./dashboard/images/delete.png" style="width:20px;heigth:20px;">Delete</button> </a></li>
                
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
  
    
    $(document).on('click','.deleteFile',function(e){   
                  e.preventDefault();
                
                //   var file_id =$(this).val(); 
                //   alert(file_id);
    
                  Swal.fire({
                      title: 'Are you sure to delete this file permanently?',
                      icon: 'warning', 
                      width:'500px' ,  
                      showCancelButton: true,
                      cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                    
                    
                   }).then((result) => {
                      if (result['isConfirmed']){
                         // Put your function here
                         
                         var file_id =$(this).val(); 
    
    
                            $.ajax({ 
    
                            type:"POST", 
                            url: "remove.php",
                            data:{ 
                            'delete_file':true,  
                            'file_id':file_id
                            }, 
                            success: function(response){  
                            var res = jQuery.parseJSON(response);
                            if(res.status == 500){ 
                                alert(res.message);
    
                            }else if(res.status==200){ 
                                  alertify.set('notifier','position', 'top-right');
                                  alertify.set('notifier','delay', 2);
                                  alertify.success(res.message); 
                                  
                        //      alertCustomize() ;
                        //    $('.msg').text(res.message);  
            
                              $('#tblfiles').load(location.href+ " #tblfiles"); 
                              window.onload = timedRefresh(2000);  
                             
                            }
                            }
    
                            });
    
    
    
    
                      }  
                      
                     
                   });
                
                      
    
                                          });   


    $(document).on('click','.restoreFile ',function(e){   
              e.preventDefault();


              Swal.fire({
                  title: 'Are you sure to Restore this File?',
                  icon: 'warning', 
                  width:'500px' ,  
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
                
                
               }).then((result) => {
                  if (result['isConfirmed']){
                     // Put your function here
                     
                     var file_id =$(this).val(); 


                        $.ajax({ 

                        type:"POST", 
                        url: "archivemodule/adminrestore.php",
                        data:{ 
                        'restore_file':true,  
                        'file_id':file_id
                        }, 
                        success: function(response){  
                        var res = jQuery.parseJSON(response);
                        if(res.status == 500){  
                          alert(res.message);
                           
                        }else{ 
                              alertify.set('notifier','position', 'top-right'); 
                              alertify.set('notifier','delay',2);
                                alertify.success(res.message);
                    //   alertCustomize() ;
                    //    $('.msg').text(res.message);  
        
                          $('#tblfiles').load(location.href+ " #tblfiles"); 
                          window.onload = timedRefresh(2000);  
                         // window.location.pathname == 'archivemodule/archivefiles'
                        }
                        }

                        });




                  }  
                  
                 
               });
            
                  

     });  


     $('.deletefiles').click(function(){ 
	var user_id = $(this).val();
    // alert(user_id );  
	 location.href = 'remove.php?id='+user_id;
	
});  
    
                    </script>