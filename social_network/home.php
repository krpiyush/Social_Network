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
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];
	?>
	<title><?php echo "$user_name"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/home_style2.css">
</head>
<style type="text/css">

	input[type="file"] {
    display: none;
	}

</style>
<body style="background-color: #D0D3D4;">

<div class="row">
	<div class="col-sm-3">
		<?php
		global $con;

				$select = "select * from users where user_name='$user_name'";

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
						<div style='background-color: #FF5733; border-radius:10px;' class='col-sm-10'>
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
							<div style='background-color: white; border-radius:10px;'> <br><h4>People You may Know</h4><hr>";
echo home_user();
						echo "	</div>
						</div>
					</center>
				</div>		<br>	
				";
				
				
				?>
	</div>

<div class="col-sm-8" style="background-color: white; margin-left: 20px; border-radius:10px;">
	<div id="insert_post" class="col-sm-12">
		<strong style="font-size: 20px;">Create Post</strong>
		<center>
		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
		<textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind?"></textarea><br>
		<label class="btn" id="upload_image_button">Select Image<input type="file" name="upload_image" size="30"></label>
		<button id="btn-post" class="btn btn-lg" style="background-color: #FF5733" name="sub"><strong style="color: white;">Post</strong></button>
		</form>
		<?php insertPost(); ?>
		</center>
		<hr size="3">
	</div>
			<center><h2><strong>News Feed</strong></h2><br></center>
	<div class="col-sm-12">

		<?php echo get_posts(); ?>
	</div>

	

</div>
</div>
<?php
	function home_user(){
		global $con;

		if(isset($_GET['search_user_btn'])){
			$search_query = htmlentities($_GET['search_user']);

			$get_user = "select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%$search_query'";


		}
		else{
			$get_user = "select * from users ORDER BY user_id DESC";
		}

		$run_user = mysqli_query($con, $get_user);

		while($row_user = mysqli_fetch_array($run_user)){
			$user_id = $row_user['user_id'];
			$f_name = $row_user['f_name'];
			$l_name = $row_user['l_name'];
			$username = $row_user['user_name'];
			$user_image = $row_user['user_image'];

			echo "
				<div class='row'>
					<div class='col-sm-12'>
						<div class='row' id=''>
						<div class='col-sm-1'>
							</div>
							<div class='col-sm-2'>
								<a href='user_profile.php?u_id=$user_id'>
									<img src='users/$user_image' class='img-circle' width='60px' height='60px' title='$username' style='float:left; margin: 1px;'/>
								</a>
							</div>
							<div class='col-sm-1'>
							</div>
							<div class='col-sm-8'>
								<a style='text-decoration:none; cursor:pointer; color: #3897f0;' href='user_profile.php?u_id=$user_id'>
								<strong> $f_name $l_name</strong>
									
								</a>
							</div>
							
						</div>
					</div>

				</div>
				<hr>
			";
		}
	}
?>
</body>
</html>