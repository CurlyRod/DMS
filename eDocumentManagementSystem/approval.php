 
 <!-- <style> 
table td{
	border-left:1px solid black;
}</style> -->
<h1 class="h3  "><span><img src="./img/sidebar/totalfile.png" alt="" style="height:40px;width:40px;"> </span>FILES</h1>
     
     <?php include('db_connection.php') ;
        $files = $conn->query("SELECT f.*,u.firstname as uname, u.lastname as lname FROM tbl_files f inner join tbl_users u on u.id = f.user_id WHERE f.archive = 0 order by date(f.date_updated) desc");
    
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
                                <th class="text-center fw-normal " style="width:18px;">Filename</th>
                                <th  class="text-center fw-normal " style="width:10px;">Extension</th>
                                <th  class="text-center fw-normal " style="width:8px;">Size</th> 
                                <th  class="text-center fw-normal ">Date Upload</th>
                                <!-- <th  class="text-center fw-normal ">Share to</th> -->
                              
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
                            <tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
                                <td class="text-center"><i><?php echo ucwords($row['uname'].' '.$row['lname']) ?></i></td>
                                <td class="text-justify"><large><span><i class="fa <?php echo $icon ?>"></i></span><b> <?php echo $name ?></b></large>
                                <input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
    
                                </td>
                                <td  class="text-center"><i class="to_file"><?php echo $row['file_type'] ?></i></td>
                                 <td  class="text-center"><i class="to_file"><?php echo $row['filesize'] ?></i></td>
                                 <td   class="text-center" ><i><?php echo date('Y/m/d h:i A',strtotime($row['date_updated'])) ?></i></td>
                            
                                 <td>
                                    <center>
                                    <div class="dropdown">
                                    <button class="btn btn-sm " type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                                    <img src="./dashboard/images/down.png" alt="" style="height:20px;width:20px;">
                                    </button>
                                    <ul class="dropdown-menu"> 
                                    <li><a class="dropdown-item "><button class="viewFile btn" value='<?php echo $row['id']?>'><img src="./dashboard/images/eye.png" style="width:20px;heigth:20px;"> 
							    	Preview</button></a></li>
                                        <li><a class="dropdown-item"><button class="acceptFile btn" value='<?php echo $row['id']?>'><img src="./dashboard/images/check-mark.png" style="width:20px;heigth:20px;"> 
                                      Accept</button></a></li>
                                       <!-- <li><a class="dropdown-item"><button class="declineFile btn" value='<?php echo $row['id']?>'><img src="./dashboard/images/cross.png" style="width:20px;heigth:20px;"> 
                                     Decline</button></a></li> 
                                             -->
                                        
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

     $('.viewFile').click(function(){ 
	var file_id = $(this).val(); 
	//  localStorage.setItem("getvalue",folder);
	location.href = 'admindashboard.php?page=readfiles&fileid='+ file_id;

});  
$(document).on('click','.acceptFile ',function(e){   
              e.preventDefault();


              Swal.fire({
                  title: 'Are you sure to Approve this File?',
                  icon: 'warning', 
                  width:'500px' ,  
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
                
                
               }).then((result) => {
                  if (result['isConfirmed']){
                     // Put your function here
                     
                     var file_id =$(this).val(); 


                        $.ajax({ 

                        type:"POST", 
                        url: "savefile.php",
                        data:{ 
                        'approve_file':true,  
                        'file_id':file_id
                        }, 
                        success: function(response){  
                        var res = jQuery.parseJSON(response);
                        if(res.status == 500){  
                          alert(res.message);
                           
                        }else{ 
                              alertify.set('notifier','position', 'top-right');
                                alertify.success(res.message);
                    //   alertCustomize() ;
                    //    $('.msg').text(res.message);  
        
                          $('#tblFiles').load(location.href+ " #tblFiles"); 
                          window.onload = timedRefresh(2000); 
                        }
                        }

                        });




                  }  
                  
                 
               });
            
                  

     });  

             
</script>