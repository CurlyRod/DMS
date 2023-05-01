<?php   

      require 'db_connection.php';  

    if(isset($_POST['delete_user'])) 
    {
        $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);  
        
        $archives = "UPDATE tbl_users SET archive='Disable' WHERE id='$user_id' "; 

        $archiveUser = mysqli_query($conn,$archives); 


        if($archiveUser) 
            { 
                $res=[ 'status' =>  200,
                'message' => 'Deleted successfully.'
                    ];
                   
    
                
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'Not Deleted.'
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;


    }





      if(isset($_POST['update_user'])) {  

     $user_id = mysqli_real_escape_string($conn,$_POST['user_id']); 

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
    $middleName = mysqli_real_escape_string($conn,$_POST['middleName']);
    $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
    $password= mysqli_real_escape_string($conn,$_POST['password']);
    $role = mysqli_real_escape_string($conn,$_POST['editrole']);
    $status = mysqli_real_escape_string($conn,$_POST['editstatus']);
    $archive= mysqli_real_escape_string($conn,$_POST['uparchive']);
        
        if($username == NULL|| $firstName  == NULL|| $middleName  == NULL || $lastName  == NULL ||$password  == NULL ){
              
                    $res=[    
                    'status' =>  422,
                    'message' => 'Please fill all fields.'
                        ];
                      
    
                    
                    echo json_encode($res) ;
                    return false;
    
        } 
        $insertStudent = "UPDATE tbl_users SET 
        username ='$username',
        firstname='$firstName', 
        middlename ='$middleName', 
        lastname ='$lastName', 
        password='$password', 
        
        role='$role', 
        status ='$status', 
        archive='$archive' 
         WHERE id ='$user_id' ";
        
    
        $execute_query =  mysqli_query($conn, $insertStudent); 
    
    
            // check if exectued 
              
            if($execute_query) 
            { 
                $res=[ 'status' =>  200,
                'message' => 'Update successfully.'
                    ];
                   
    
                
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'Not updated successfully.'
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;
          }



      // ---------GET USER_ID FROM DATABASE---- ---  /// 

if(isset($_GET['user_id'])) 
{ 
    $userId = mysqli_real_escape_string($conn,$_GET['user_id']); 

    $selectID = "SELECT * FROM tbl_users WHERE id='$userId' "; 
    $execute_query = mysqli_query($conn,$selectID); 

    //CHECK RETURNING VALUE 
    
        if(mysqli_num_rows($execute_query)== 1) 
        {   

            $user_record = mysqli_fetch_array($execute_query); 


            $res=[    
                'status' =>  200,
                'message' => 'Record Found.',
                'data' => $user_record
                    ];
                echo json_encode($res) ;
                return false;
        }
        else 
        { 
            $res=[    
                'status' =>  404,
                'message' => 'No record found.',
                    ];
                echo json_encode($res) ;
                return false;
        }
}  



//
// ---------SAVE USER INTO DATABASE---- ---  /// 
/// 

if(isset($_POST['save_user'])) {  

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
    $middleName = mysqli_real_escape_string($conn,$_POST['middleName']);
    $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
    $password= mysqli_real_escape_string($conn,$_POST['password']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $archive= mysqli_real_escape_string($conn,$_POST['archive']);
    
    if($username == NULL|| $firstName  == NULL|| $middleName  == NULL || $lastName  == NULL ||$password  == NULL ){
          
                $res=[    
                'status' =>  422,
                'message' => 'Please fill all fields.'
                    ];
                  

                
                echo json_encode($res) ;
                return false;

    } 
    $insertStudent = "INSERT INTO tbl_users (username,firstname,middlename,lastname,password,role,status,archive) 
    VALUES ('$username','$firstName','$middleName','$lastName','$password','$role','$status', '$archive')" ; 

    $execute_query =  mysqli_query($conn, $insertStudent); 


        // check if exectued 
          
        if($execute_query) 
        { 
            $res=[ 'status' =>  200,
            'message' => 'Created successfully.'
                ];
               

            
            echo json_encode($res) ;
            return false;

         
        } 
        else{ 

            $res=[ 'status' =>  500,
            'message' => 'No user created.'
        ];
               

            } 
            echo json_encode($res) ;
            return false;
        }
    

?>