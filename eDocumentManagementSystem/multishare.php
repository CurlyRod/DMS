<?php  
include 'db_connection.php';
    if(isset($_POST['sendfiles'])) 
    { 
        $userSession = $_SESSION['id'];
        $file_id = $_POST['fileid'];    
        $shareMessage = $_POST['shareMessage'];
        $user_list  =$_POST['userlist'];  
      

            foreach($user_list as $userlist)
            { 
                    $query = "INSERT INTO tbl_share (file_id,public_to,user_id,message) VALUES ('$file_id','$userlist','$userSession','$shareMessage')";
                    
                    $query_run = mysqli_query($conn,$query);
            }    

          
            if($query_run)
            { 
                $res=[    
                    'status' =>200,
                    'message' => 'File successfully shared!'
                    
                        ];
                    echo json_encode($res) ;
                    return false;
            } 

            else 
            { 
                $res=[    
                    'status' =>  422,
                    'message' => 'File not shared.',
                        ];
                    echo json_encode($res) ;
                    return false;
            }
    
         
        
        
        
        } 


        
   if(isset($_POST['updatefileshare'])) 
   { 
         $update_fileid = $_POST['fileid'];    
         $update_userlist  =$_POST['userlist']; 
         $shareMessage = $_POST['shareMessage'];
             $queryfetch = "SELECT * FROM tbl_share WHERE  file_id = '$update_fileid' "; 
             $query_runs = mysqli_query($conn,$queryfetch); 
                
             $user_public_id =[];
             foreach($query_runs as $fetchuser) 
             { 
                 $user_public_id[] = $fetchuser['public_to'];
             } 

             //FOR INSERTING  A NEW RECORD! 

             foreach($update_userlist as $input_value) 
             { 
                if(!in_array($input_value, $user_public_id)) 
                { 
                  $insertQuery = "INSERT INTO tbl_share (file_id,public_to,message) VALUES ('$update_fileid','$input_value','$shareMessage')"; 
                  $insertQuery_run = mysqli_query($conn,$insertQuery);
                }
             } 

             //DELETE OLD RECORD FOR UPDATE 
             foreach($user_public_id as $fetchFile)
             { 
                    if(!in_array($fetchFile,  $update_userlist))
                    { 
                     $deleteQuery ="DELETE FROM tbl_share WHERE file_id = '$update_fileid' AND public_to = '$fetchFile' ";  
                     $deleteQuery_runs = mysqli_query($conn,$deleteQuery);

                    } 

                
                }   
            if($deleteQuery_runs)
            { 
                $res=[    
                    'status' =>200,
                    'message' => 'Successfully unshared files'
                    
                        ];
                        ob_clean();
                    echo json_encode($res) ;
                    return false;
            } 

            else 
            { 
                $res=[    
                    'status' =>  422,
                    'message' => 'No record found.',
                        ]; 
                        ob_clean();
                    echo json_encode($res) ;
                    return false;
            }  
           
        
           
           
           
     } 

    
     
  

  //// SHARE FOLDER // // / / / / 
 

   
  if(isset($_POST['sendfolder'])) 
  { 
      $userSession = $_SESSION['id'];
      $file_id = $_POST['folderid'];   
      $user_list  =$_POST['userlist']; 

          foreach($user_list as $userlist)
          { 
                  $query = "INSERT INTO tbl_share_folder (folder_id,public_to,user_id) VALUES ('$file_id','$userlist','$userSession')";
                  
                  $query_run = mysqli_query($conn,$query);
          }    

        
          if($query_run)
          { 
              $res=[    
                  'status' =>200,
                  'message' => 'Folder successfully shared!'
                  
                      ];
                  echo json_encode($res) ;
                  return false;
          } 

          else 
          { 
              $res=[    
                  'status' =>  422,
                  'message' => 'File not shared.',
                      ];
                  echo json_encode($res) ;
                  return false;
          }
  
       
      
      
      
      }  




      if(isset($_POST['updatefoldershare'])) 
   { 
         $update_fileid = $_POST['folderid'];    
         $update_userlist  =$_POST['userlist']; 
        
             $queryfetch = "SELECT * FROM tbl_share_folder WHERE  folder_id = '$update_fileid' "; 
             $query_runs = mysqli_query($conn,$queryfetch); 
                
             $user_public_id =[];
             foreach($query_runs as $fetchuser) 
             { 
                 $user_public_id[] = $fetchuser['public_to'];
             } 

             //FOR INSERTING  A NEW RECORD! 

             foreach($update_userlist as $input_value) 
             { 
                if(!in_array($input_value, $user_public_id)) 
                { 
                  $insertQuery = "INSERT INTO tbl_share_folder (folder_id,public_to) VALUES ('$update_fileid','$input_value')"; 
                  $insertQuery_run = mysqli_query($conn,$insertQuery);
                }
             } 

             //DELETE OLD RECORD FOR UPDATE 
             foreach($user_public_id as $fetchFile)
             { 
                    if(!in_array($fetchFile,  $update_userlist))
                    { 
                     $deleteQuery ="DELETE FROM tbl_share_folder WHERE folder_id = '$update_fileid' AND public_to = '$fetchFile' ";  
                     $deleteQuery_runs = mysqli_query($conn,$deleteQuery);

                    } 

                
                }   
            if($deleteQuery_runs)
            { 
                $res=[    
                    'status' =>200,
                    'message' => 'Successfully unshared folder'
                    
                        ];
                        ob_clean();
                    echo json_encode($res) ;
                    return false;
            } 

            else 
            { 
                $res=[    
                    'status' =>  422,
                    'message' => 'No record found.',
                        ]; 
                        ob_clean();
                    echo json_encode($res) ;
                    return false;
            }  
           
        
           
           
           
     } 

    
     
  
/// FOR COLLABORATION 
 

 
 

if(isset($_POST['send_colab_folder'])) 
{ 
    $userSession = $_SESSION['id'];
    $file_id = $_POST['folderid'];   
    $user_list  =$_POST['userlist']; 

        foreach($user_list as $userlist)
        { 
                $query = "INSERT INTO tbl_share_folder_collab (folder_id,public_to,creator_id) VALUES ('$file_id','$userlist','$userSession')";
                
                $query_run = mysqli_query($conn,$query);
        }    

      
        if($query_run)
        { 
            $res=[    
                'status' =>200,
                'message' => 'Folder successfully shared!'
                
                    ]; 
                    ob_clean();
                echo json_encode($res) ;
                return false;
        } 

        else 
        { 
            $res=[    
                'status' =>  422,
                'message' => 'Folder not shared.',
                    ]; 
                    ob_clean();
                echo json_encode($res) ;
                return false;
        }

     
    
    
    
    }  
 
    if(isset($_POST['update_collab_foldershare'])) 
    { 
          $update_fileid = $_POST['folderid'];    
          $update_userlist  =$_POST['userlist']; 
         
              $queryfetch = "SELECT * FROM tbl_share_folder_collab WHERE  folder_id = '$update_fileid' "; 
              $query_runs = mysqli_query($conn,$queryfetch); 
                 
              $user_public_id =[];
              foreach($query_runs as $fetchuser) 
              { 
                  $user_public_id[] = $fetchuser['public_to'];
              } 
 
              //FOR INSERTING  A NEW RECORD! 
 
              foreach($update_userlist as $input_value) 
              { 
                 if(!in_array($input_value, $user_public_id)) 
                 { 
                   $insertQuery = "INSERT INTO tbl_share_folder_collab (folder_id,public_to) VALUES ('$update_fileid','$input_value')"; 
                   $insertQuery_run = mysqli_query($conn,$insertQuery);
                 }
              } 
 
              //DELETE OLD RECORD FOR UPDATE 
              foreach($user_public_id as $fetchFile)
              { 
                     if(!in_array($fetchFile,  $update_userlist))
                     { 
                      $deleteQuery ="DELETE FROM tbl_share_folder_collab WHERE folder_id = '$update_fileid' AND public_to = '$fetchFile' ";  
                      $deleteQuery_runs = mysqli_query($conn,$deleteQuery);
 
                     } 
 
                 
                 }   
             if($deleteQuery_runs)
             { 
                 $res=[    
                     'status' =>200,
                     'message' => 'Successfully unshared folder'
                     
                         ];
                         ob_clean();
                     echo json_encode($res) ;
                     return false;
             } 
 
             else 
             { 
                 $res=[    
                     'status' =>  422,
                     'message' => 'No record found.',
                         ]; 
                         ob_clean();
                     echo json_encode($res) ;
                     return false;
             }  
            
         
            
            
            
      } 
 
     
      
   /////// UPDATE MESSAGE // 
   if(isset($_POST['value'])) 
   {
       $file_id = $_POST['file_id'];  
       $folder_id =  $_POST['value'];   
       //$shareMessage = $_POST['shareMessage'];
       $archives = "UPDATE tbl_share SET message = '$folder_id' WHERE file_id='$file_id' "; 

       $archiveUser = mysqli_query($conn,$archives); 


       if($archiveUser) 
           { 
               $res=[ 'status' =>  200,
               'message' => 'Message update successfully.'
                   ];
                  
   
               
               echo json_encode($res) ;
               return false;
   
            
           } 
           else{ 
   
               $res=[ 'status' =>  500,
               'message' => 'Not updated.'
           ];
                  
   
               } 
               echo json_encode($res) ;
               return false;


   }





   if(isset($_POST['unshareFolder'])) 
   { 
         $update_fileid = $_POST['folderid'];    
         $update_userlist  =$_POST['userlist']; 
       
             $queryfetch = "SELECT * FROM tbl_share_folder WHERE  folder_id = '$update_fileid' "; 
             $query_runs = mysqli_query($conn,$queryfetch); 
                
             $user_public_id =[];
             foreach($query_runs as $fetchuser) 
             { 
                 $user_public_id[] = $fetchuser['public_to'];
             } 

             //FOR INSERTING  A NEW RECORD! 

             foreach($update_userlist as $input_value) 
             { 
                if(!in_array($input_value, $user_public_id)) 
                { 
                  $insertQuery = "INSERT INTO tbl_share_folder (folder_id,public_to) VALUES ('$update_fileid','$input_value')"; 
                  $insertQuery_run = mysqli_query($conn,$insertQuery);
                }
             } 

             //DELETE OLD RECORD FOR UPDATE 
             foreach($user_public_id as $fetchFile)
             { 
                    if(!in_array($fetchFile,  $update_userlist))
                    { 
                     $deleteQuery ="DELETE FROM tbl_share_folder WHERE folder_id = '$update_fileid' AND public_to = '$fetchFile' ";  
                     $deleteQuery_runs = mysqli_query($conn,$deleteQuery);

                    } 

                
                }   
            if($deleteQuery_runs)
            { 
                $res=[    
                    'status' =>200,
                    'message' => 'Successfully unshared folder'
                    
                        ];
                        ob_clean();
                    echo json_encode($res) ;
                    return false;
            } 

            else 
            { 
                $res=[    
                    'status' =>  422,
                    'message' => 'No record found.',
                        ]; 
                        ob_clean();
                    echo json_encode($res) ;
                    return false;
            }  
           
        
           
           
           
     } 

?>