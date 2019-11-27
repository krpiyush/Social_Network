<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
	<title><?php echo "$user_name";?>'s wallet</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/home_style2.css">
</head>
<body>
	<center><h2>My Wallet</h2></center>
	<br>
<div class="row">
	<div class="col-sm-3">
		<?php
		if (isset($_GET['u_id'])) {
			$u_id = $_GET['u_id'];
			# code...
		}
		if ($u_id < 0 || $u_id == "") {
			echo "<script>window.open('home.php','_self')</script>";
			
		}else{
				if (isset($_GET['u_id'])) {
				global $con;
				$user_id = $_GET['u_id'];

				$select = "select * from users where user_id='$user_id'";

				$run = mysqli_query($con,$select);
				$row = mysqli_fetch_array($run);
				$id = $row['user_id'];
				$image = $row['user_image'];
				$name = $row['user_name'];
				$f_name = $row['f_name'];
				$l_name  = $row['l_name'];
				$describe_user = $row['describe_user'];
				$country = $row['user_country'];
				$gender = $row['user_gender'];
				$register_date = $row['user_reg_date'];
				$user_cover = $row['user_cover'];

				echo "
				<div class='row'>
					<div class='col-sm-2'>
					</div>
					<center>
						<div style='background-color: #FF5733;' class='col-sm-10'>
							<h2> <strong style='color: white;'>Your Information</strong> </h2>
							<img src='users/$image' class='img-circle' height='150px' width='150px'><br><br>
							<ul class='list-group'>
								<li class='list-group-item' title='username'>
									<strong>Name:</strong> $f_name $l_name
								</li>
								<li class='list-group-item' title='user status'>
									<strong>Status:</strong><strong style='color: grey;'> $describe_user</strong>
								</li>
								<li class='list-group-item' title='Gender'>
									<strong>Gender:</strong> $gender
								</li>
								<li class='list-group-item' title='Country'>
									<strong>Country:</strong> $user_country
								</li>
								<li class='list-group-item' title='User Registration Date'>
									<strong>Registered on:</strong> $register_date
								</li>
							</ul>
						</div>
					</center>
				</div>			
				";
			}
		}
		?>
	</div>
	<div class="col-sm-8">
		<?php 
			if (isset($_GET['u_id'])) {
				global $con;
				$user_id = $_GET['u_id'];

				//no of comments

				$no_comment = "SELECT * FROM comments where user_id='$user_id'";
				$run_comment = mysqli_query($con,$no_comment);
				$no_of_comment = mysqli_num_rows($run_comment);

				// no of msg

				$no_msg = "SELECT * FROM user_messages where user_from='$user_id'";
				$run_msg = mysqli_query($con,$no_msg);
				$no_of_msg = mysqli_num_rows($run_msg);
				

				//no of posts

				$no_post = "SELECT * FROM posts where user_id='$user_id'";
				$run_post = mysqli_query($con,$no_post);
				$no_of_post = mysqli_num_rows($run_post);
				

				echo "
					<div class='col-sm-4'>
						<div class='panel panel-primary'>
						<div class='panel-heading'><h3>Total Comments</h3></div>
						  <div class='panel-body' style='background-color: #2471A3;'>
			<strong style='color: white; font-size: 60px;'>$no_of_comment</strong><font style=' color: white;font-size:30px;'> Points</font><br><p align='right' style='color: white;'>1 Comment = 1 Point*</p>
						  </div>
						</div>
					</div>
					<div class='col-sm-4'>
						<div class='panel panel-primary'>
						<div class='panel-heading'><h3>Total Messages</h3></div>
						  <div class='panel-body' style='background-color: #2471A3;'>
						    <strong style='color: white; font-size: 60px;'>$no_of_msg</strong><font style=' color: white;font-size:30px;'> Points</font><br><p align='right' style='color: white;'>1 Message = 1 Point*</p>
						  </div>
						</div>
					</div>
					<div class='col-sm-4'>
						<div class='panel panel-primary'>
						<div class='panel-heading'><h3>Total Posts</h3></div>
						  <div class='panel-body' style='background-color: #2471A3;'>
						    <strong style='color: white; font-size: 60px;'>$no_of_post</strong><font style=' color: white;font-size:30px;'> Points</font><br><p align='right' style='color: white;'>1 Post = 1 Point*</p>
						  </div>
						</div>
					</div>
					<br>
					<br>
				";

				$total_points= $no_of_post + $no_of_msg + $no_of_comment;

				echo "
					<div class='col-sm-8'>
						<div class='panel'>
						<div class='panel-heading' style='background-color: #7D3C98;'><h3 style='color: white;'>Total Points Earned</h3></div>
						  <div class='panel-body' style='background-color: #6C3483;'>
						    <strong style='color: white; font-size: 40px;'>$total_points</strong><font style=' color: white;font-size:30px;'> Points</font><br>
						    <p align='right' style='color: white;'>10 points = ₹1**</p>
						  </div>
						</div>
					</div>
					<div class='col-sm-4'>
					<br>
					<br>
					<br>
						<button type'button' class='btn btn-danger btn-lg btn-block'>Reedem</button>
					</div>
				";




			}
		?>
	</div>

</div>
</body>
</html>