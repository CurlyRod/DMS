

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="./newstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Login Credentials</title>
</head>
<body>
    <section class="side">
        <img src="./Logo.png" alt="" id="logo">
    </section>

    <section class="main">
        <div class="login-container">
            <p class="title">Docu SaveIt</p>
            <div class="separator"></div>
            <p class="welcome-message">Please, provide login credential to proceed</p>

            <form action="#" class="login" id="LoginForm">
                <div class="form-control">
                <input type="text" name="username" id="username" placeholder="Username" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                <input type="password" name ="password" id="password" placeholder="Password" required>
                    <i class="fas fa-lock"></i>
                </div>
               
                <div class="center-container" id="wrapper"> 
                  <button class="submit">Login</button>
                  
                  <a href="facultylogin.php" > 
                  <button class="submit"id="faculty" onclick="myFunction()">Faculty</button>
                 </a>
                </div>   
                <div class="center-container" id="wrapper"> 
                </div>  
               
               
               
            </form>
        </div>
    </section>
    <script src="./src/js/jquery-3.6.1.js" type="text/javascript"> </script>   
     <script src="./src/sweetalert/sweetalert2@11.js" type="text/javascript"> </script>   
   <script>
     $("#LoginForm").submit( (e) => {
            e.preventDefault();
            
            var form_login = $("#LoginForm").serialize();
            $.ajax({
               url : "ajax_login.php",
               method: 'post',
               data: form_login,
               success: function(res) {
                  var data = $.parseJSON(res);
                  //alert(data.message);  
                              
                        

                  if (data.status == 'success') {   
                          
                 Swal.fire({
                  title: 'Successfully Login!',
                  icon: 'success', 
                  width:'500px' ,
                
                
               }).then((result) => {
                  if (result['isConfirmed']){
                     // Put your function here
                     window.location = './userdashboard.php?page=userdash';
                  } 
                 
               })     
                     
                  }else{  
                     
                     Swal.fire({
                  title: 'Check username or password !',
                  icon: 'error', 
                  width:'500px' ,
                
                
               }).then((result) => {
                  if (result['isConfirmed']){
                     // Put your function here
                     window.location = 'index.php';
                  } 
                 
               })      


                  }
               }
            })
         })


      </script>
      <script>
function myFunction() {
 document.getElementById("faculty"); 
 window.location = 'facultylogin.php';
}
</script>
   
</body>
</html>