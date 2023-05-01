<?php
include 'db_connection.php';
if(!isset($_SESSION['id'])) header("location:index.php");
$id = $_SESSION['id'];
$sql = "Select * from tbl_users where id = '$id' ";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);



?> 

<!DOCTYPE html>
<html lang="en">
<?php include './dashboard/header.php';?>

<body> 
    <style> 
    *{  
        font-family: 'Poppins', sans-serif; 
    } 
    div.card {

box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
border: 1px;
}  


/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #fff; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #222E3C; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
} 

</style> 

    
   
	<div class="wrapper">
	
	
			<?php 
			
				include('./facultysidebar.php');
			?>
    
                <main class="content">    

                <div class="container-fluid p-0">  

				<div class="success-alert " style=" padding: 10px 20px;"> 


				<span class="img"><img src="./tick.png" alt="" style="height:35px; width:35px;"></span>
				<span class="msg"></span>
				<div class="close-btn">
				<span class="fas fa-times fa-2x"></span>
				</div>
				</div> 


				<?php 

function humanFileSize($size,$unit="") {
  if( (!$unit && $size >= 1<<30) || $unit == " GB")
    return number_format($size/(1<<30),1)." GB";
  if( (!$unit && $size >= 1<<20) || $unit == " MB")
    return number_format($size/(1<<20),0)." MB";
  if( (!$unit && $size >= 1<<10) || $unit == " KB")
    return number_format($size/(1<<10),0)." KB";
  return number_format($size)." bytes";
}
?>
				<?php 
				 		include 'db_connection.php'; 
						$query = "SELECT sum(byte_size)as size, MONTHNAME(date_upload) as dateuploads,COUNT(date_upload) as uploads from tbl_files WHERE user_id = '".$_SESSION['id']."'  GROUP by STR_TO_DATE(CONCAT('0001 ', dateuploads, ' 01'), '%Y %M %d') ";
						$execute_run = mysqli_query($conn,$query);	

						foreach($execute_run as $data)
						{ 
							$totaluploads[] = $data['uploads']; 
							$labeldate[] = $data['dateuploads'];  
							$labeldates[] =humanFileSize( $data['size']);  
							$labeldatess[] = $data['size']; 


             
						} 
          
				?>

                
                
                
                
        

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">MONITORING FOR TOTAL UPLOAD BAR GRAPH</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="chart chart-sm">
										<canvas id="chartjs-dashboard-lines"></canvas>
									</div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>-->
      </div> 
    </div>
  </div>
</div>



                <?php 
				
				$page = isset($_GET['page']) ? $_GET['page'] :'facultyhome'; 
						 include $page.'.php' ;
				?>
                </div>
                   
                </main>

			
		
	</div>
 
   
    
    
    <script src="./src/js/flatpickr.js" type="text/javascript"> </script>
    <script src="./bootstrap/jquery.dataTables.min.js"type="text/javascript"></script> 
    <script src="./src/js/dataTables.bootstrap5.min copy.js"type="text/javascript"></script>

	
	<script>
	


 $(document).ready(function () {
    $('#tblfiles').DataTable();
});  

function alertCustomize() 
 { 
    $('.success-alert').addClass("show");
          $('.success-alert').removeClass("hide");
          $('.success-alert').addClass("showAlert");  
           
           setTimeout(function(){
             $('.success-alert').removeClass("show");
             $('.success-alert').addClass("hide");
           },1000);
          
 } 
 $(document).ready(function() {
        $('.userlist-for-share').select2()


    }); 
	</script> 
	 <script> 
    	 function formatBytes(bytes,decimals) {
    if(bytes == 0) return '0 Bytes';
    var k = 1024,
        dm = decimals || 2,
        sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
 }
    </script>
      	<script>  
			document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-lines").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			var lineColor =gradient.addColorStop(0, "rgba(255, 135, 71, 0.8)");
		

			gradient.addColorStop(0, "rgba(0, 176, 142, 0.67)");
			gradient.addColorStop(1, "rgba(223, 176, 167, 0.82)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-lines"), {
				type: "bar",
				data: {
					labels: <?php echo json_encode($labeldates) ?>,
					datasets: [{
						label: "File upload",
						fill: true,
						backgroundColor: gradient,
						borderColor: lineColor,
						data: <?php echo json_encode($totaluploads)?>,
					}] 
          
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});  
	

	</script>


</body>

</html>
