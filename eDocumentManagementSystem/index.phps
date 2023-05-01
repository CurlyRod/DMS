<?php
   include 'db_connection.php';
   if(isset($_SESSION['id'])) header("location:dashboard.php");
?> 


<!DOCTYPE html>

<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login Credentials</title>
      <link rel="stylesheet" href="formlogin.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body> 
     
     
     <style> 
 
  </style>
      <div class="login_body">
          
      </div> 
      

      <div class="wrapper">
        <div class="title-text"> 
           <div class="title login" style=" font-size:20px;text-align: center;">
             
             Document Management System
           </div>
           <div class="title signup">
              Signup Form
           </div>
        </div>
        <div class="form-container">
           <div class="slide-controls ">
              <input type="radio" name="slide" id="login" checked>
              <input type="radio" name="slide" id="signup">
              <label for="login" class="slide login">Login</label>
              <label for="signup" class="slide signup"></label>
              <div class="slider-tab"></div>
           </div>
           <div class="form-inner">
              <form action="#" class="login" id="LoginForm">
                 <div class="field">
                    <input type="text" name="username" placeholder="Username" required>
                 </div>
                 <div class="field">
                    <input type="password" name ="password" placeholder="Password" required>
                 </div>
                 <div class="pass-link">
                    <a href="#">Forgot password?</a>
                 </div>
                 <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login">
                 </div>
                 <div class="signup-link">
                    Not a member? <a href="">Signup now</a>
                 </div>
              </form>
              <form action="#" class="signup" id="SIGNUPFORM">
                 <div class="field">
                    <input type="text" name="email" placeholder="Username" required>
                 </div>
                 <div class="field">
                    <input type="password" name="password" placeholder="Password" required>
                 </div>
                 <div class="field">
                    <input type="text" name="name" placeholder="Enter Your Name" required>
                 </div>
                 <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                 </div>
              </form>
           </div>
        </div>
     </div>
     <script src="./src/js/jquery-3.6.1.js" type="text/javascript"> </script>   
     <script src="./src/sweetalert/sweetalert2@11.js" type="text/javascript"> </script>   

    <script>
       
       
       $(window).on("load",function(){
     $(".loader-wrapper").fadeOut("slow");
});
       
       const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         const signupBtn = document.querySelector("label.signup");
         const signupLink = document.querySelector("form .signup-link a");
         signupBtn.onclick = (()=>{
           loginForm.style.marginLeft = "-50%";
           loginText.style.marginLeft = "-50%";
         });
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
         signupLink.onclick = (()=>{
           signupBtn.click();
           return false;
         });

         $("#SIGNUPFORM").submit( (e) => {
            e.preventDefault();


            
            var form = $("#SIGNUPFORM").serialize();
            
            $.ajax({
               url : "ajax_login.php",
               method: 'post',
               data: form,
               success: function(res) {
                  alert(res);
                  $("#SIGNUPFORM")[0].reset();
                  
               }
            })
         })
         
         

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
      
   </body>
</html>