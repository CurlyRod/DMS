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
			
				include('./dashboard/sidebar.php');
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
				
				$page = isset($_GET['page']) ? $_GET['page'] :'home'; 
						 include $page.'.php' ;
				?>
                </div>
                   
                </main>

			
		
	</div>
 
   
    
    
    <script src="./src/js/flatpickr.js" type="text/javascript"> </script>
    <script src="./bootstrap/jquery.dataTables.min.js"type="text/javascript"></script> 
    <script src="./src/js/dataTables.bootstrap5.min copy.js"type="text/javascript"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Chrome", "Firefox", "IE"],
					datasets: [{
						data: [4306, 3801, 1689],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script> 
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>
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

</body>

</html>
