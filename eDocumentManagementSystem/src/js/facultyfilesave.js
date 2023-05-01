
const dropArea = document.querySelector('.drop-section');
const listSection= document.querySelector('.list-section');
const listContainer = document.querySelector('.list');
const fileSelector =document.querySelector('.file-selector');
const fileSelectorInput = document.querySelector('.file-selector-input');  
var input = document.getElementById("files");
var maxFiles = 60;
var files = [];


fileSelector.onclick =() => fileSelectorInput.click()


// var maxSize = 2147483648;//2GB 
var maxSize =  4294967296;//4GB  TO UPLOAD
var maxStorage =  32212254720;//30GB
input.addEventListener("change", function(e) {
    
    $.ajax({
        type:"GET",
        url:"totalsize.php",
        success: function(response){ 
          var res = jQuery.parseJSON(response);
          if(res.status == 422){ 
              alert(res.message);
          }else if(res.status == 200)
          {  
            var userStorage = parseInt(res.data);  
            var totalSizes = userStorage +totalSize;
            console.log(formatBytes(userStorage+maxSize));
            console.log(formatBytes(res.data)); 
           //console.log( formatBytes(2147483648)); 
           console.log(totalSize); 
           if(totalSizes>maxStorage)
           { 
            console.log(formatBytes(totalSizes));
            console.log(totalSize);
           // alert('EXCEEDS');  
           alertify.set('notifier','position', 'top-right'); 
           alertify.set('notifier','delay', 2); 
           alertify.error('Exceeded the allotted storage capacity.');
            
           }else { 
            console.log(formatBytes(totalSizes)); 


            if (totalSize >maxSize) { 
                alertify.set('notifier','position', 'top-right');
                alertify.error('The total file size exceeds the limit of 4GB.'); 
                alertify.set('notifier','delay', 1);
               // alert('The total file size exceeds the limit of 5MB.');
               // fileInput.value = ''; // clear the selected files 
               document.querySelector('.file-selector-input').value = "";
            }  
        
            if  (files.length > maxFiles)
            { 
                alertify.set('notifier','position', 'top-right');
                alertify.error('Reached the limit for uploaded files.');
            } else{ 
                [...fileSelectorInput.files].forEach((file)=>{
                    if(typeValidation(file.type)){
                       console.log(file);
            
                        uploadFile(file)
                    }
                    else
                    {  
                       
                        alertify.set('notifier','position', 'top-right');
                        alertify.error('Uploading files are not supported');
                    }
                })
             }
           


           }

          }
        }
     });
     files = e.target.files; 
     var totalSize = 0; 
     for (var i = 0; i < files.length; i++) {
      totalSize += files[i].size;
     
     } 
    

    

});



function formatBytes(bytes,decimals) {
    if(bytes == 0) return '0 Bytes';
    var k = 1024,
        dm = decimals || 2,
        sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
 }


//validation
function typeValidation(type){
    var splitType =type.split('/')[1]
    if(splitType == 'octet-stream' || splitType=='x-bat' || splitType == 'x-msdownload' || splitType == undefined)
    {
       console.log(splitType);
        return false
    }else if('application/vnd.rar'){ 
        return true;
    }
    else{
        console.log(splitType);
        return true;
    }
}




function uploadFile(file)
{

    var remove = document.getElementById("remove");
    remove.addEventListener("click", function() {
     
 
        Swal.fire({
            title: "Are you sure to remove list of file's?",
            icon: 'warning', 
            width:'600px' ,
            showCancelButton: true,
            cancelButtonColor: '#d33',
          confirmButtonText: 'Remove all!'
          
          
          
         }).then((result) => {
            if (result['isConfirmed']){
               // Put your function here 
              
               while ( li.querySelector('.cancel')) {
                li.querySelector('.cancel').remove();
              }
            document.querySelector('.file-selector-input').value = "";
             dropArea.classList.remove('drag-over-effect');
              window.location = './facultydashboard.php?page=facultyfileupload';
            } 
           
         }) 

    });



  listSection.style.display = 'block'
  var li = document.createElement('li')
//  li.classList.add('in-prog'); 
  li.innerHTML = ` 
      
     <div class="col"> 
     
 
       <img src="./src/img/icons/brief "  class="mt-1"alt="" style="height:45px;">  
      
       
        </div>  
       
        
        


        <div class="col">
        <div class="file-name">
            <div class="file">${file.name}</div>
            <span>0%</span>
        </div>
        <div class="file-progress">
            <span></span>
        </div>

        <div class="file-size">
         ${formatBytes(file.size)}
        </div>
        </div>


        <div class="col">
       <img src="./pause.png" class="cross" id="cross">
       <img src="./reload.png" class="crosss" id="crosss">      
        </div>  
            
     <img src="./clear.png " class="cancel" alt="" style="height:15px;margin-top:0px;margin-right:10px;cursor:pointer;">  
    
       




  `
    //DO UPLOADING CODE
  //  console.log(file);

  listContainer.prepend(li)
  var http =  new XMLHttpRequest()
  var data = new FormData();
 
  var flder_id = document.querySelector("#filesid"); 
  var value = flder_id.value; 
  console.log(value); 
  data.append('file',file); 
  data.append('value',value);
 
    http.onload = () =>
    {

        dropArea.classList.remove('drag-over-effect')
        
       
        var res = jQuery.parseJSON(http.responseText)

        if(res.status == 200){ 
            li.querySelector('#cross').style.display = 'none';
            li.querySelector('#crosss').style.display = 'none';
         
            alertify.set('notifier','position', 'top-right');
            alertify.success(res.message);  

            console.log(res.message);
          // li.classList.remove('in-prog')
            $("#files").val('')
            $('#files').load(location.href+ " #files");



        }
        else if(res.status == 422)
        {
           alert(res.message);
           li.classList.add('complete')
           li.classList.remove('complete')

        }




    }

    http.upload.onprogress = (e) =>
    {
      
        var percent_completed = (e.loaded / e.total)*100
        li.querySelectorAll('span')[0].innerHTML = Math.round(percent_completed)+ '%'
        li.querySelectorAll('span')[1].style.width = percent_completed + '%'
        li.classList.remove('in-prog')
       // li.classList.add('in-prog')
    }

    //Using ajax.


        http.open('POST','./save_file.php',true)
        http.send(data)





    li.querySelector('.cross').onclick =()  => http.abort()
    {
     
       li.classList.remove('in-prog')
      dropArea.classList.remove('drag-over-effect')
      li.querySelector('#crosss').style.display = 'none';

    }
    li.querySelector('.cross').onclick =() =>
    {
       li.querySelector('.cross').style.display = 'none';
       http.abort(); 
       li.classList.remove('in-prog')
       li.querySelector('#crosss').style.display = 'block';

    }




    li.querySelector('.crosss').onclick=()=>
    {
        // var http =  new XMLHttpRequest()
         var data = new FormData();
       data.append('file',file);



       http.open('POST','./save_file.php',true)
     //   http.setRequestHeader("Content-Type", "multipart/form-data");
        http.send(data);
        console.log(file); 
      
        li.querySelector('#cross').style.display = 'block';
        li.querySelector('#crosss').style.display = 'none';
        //document.getElementById(".cross").classList.add("visible");

    }

    li.querySelector('.cancel').onclick=()=>
    {

        
        http.abort();   
         li.remove();
        document.querySelector('.file-selector-input').value = "";
        dropArea.classList.remove('drag-over-effect')

       //  alert('hello');
    }




}


