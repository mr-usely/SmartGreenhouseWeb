<?php
session_start();
include_once('base/includes/db.php');
error_reporting(1);

$username = '';
$password = '';

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = $_POST['remember'];
	
	if($con === false){
		if($username=="admin" && $password == "admin"){
			$_SESSION['username']=$username;
			if($_SESSION['username'] == $username){
				header("Location: config/index.php?mod=base&menu=db&edit=true");
				die();
			}
		}else{
				header("Location: index.php");
				die();
			}
	}else{
		// CHECK USER IN DATABASE
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$query = "SELECT * FROM users";
		$result = mysqli_query($con, $query);
		// SET COOCKIES
		if(isset($_POST['remember'])){
			setcookie("username", $username, time() + (86400 * 30), "/");
			setcookie("password", $password, time() + (86400 * 30), "/");
		}
		
		
		while($row = mysqli_fetch_assoc($result)){
			if($row['name'] == $username && $row['password']==$password){
				$_SESSION['username'] = $row['name'];
				$_SESSION['user_id'] = $row['id'];
				// WHERE TO REDIRECT
				$query = "SELECT * FROM modules ORDER BY seq LIMIT 1";
				$result = mysqli_query($con, $query);
				$module = mysqli_fetch_assoc($result);
				$module_name = $module['link'];
				$module_id = $module['id'];
				
				$query = "SELECT * FROM menus ORDER BY seq LIMIT 1";
				$result = mysqli_query($con, $query);
				$menu = mysqli_fetch_assoc($result);
				$menu_name = $menu['link'];
				
				$link = $module_name . '/index.php?mod='.$module_name . '&menu=' . $menu_name;
				header("Location: $link");
				die();
			}elseif ($row['name'] == false && $row['password'] == false) {
				header("Location: config/index.php?mod=base&menu=db&edit=true");
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=0">
		<link rel="icon" href="base/img/DA_pic.png" type="image/x-icon" />
		<title>Admin login</title>
		<!-- Bootstrap core CSS -->
		<link href="base/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="base/css/signin.css" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<form class="form-signin" action="" method="post">
				<h3 class="form-signin-heading"><small>Smart Greenhouse Monitoring System</small></h3>
				<div class="form-group">
					<label class="sr-only" for="exampleInputAmount"></label>
					<div class="input-group">
					  <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
					  <input <?php if(isset($_COOKIE['username'])) echo "value='".$_COOKIE['username']."'"; ?> type="text" name="username" class="form-control input-sm" id="exampleInputAmount" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
					  <div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock" aria-hidden="true"></span></div>
					  <input <?php if(isset($_COOKIE['password'])) echo "value='".$_COOKIE['password']."'"; ?> type="password" name="password" class="form-control input-sm" id="exampleInputAmount" placeholder="Password">
					</div>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name='remember'>Remember me
					</label>
				</div>
				<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Enter</button>
				<br/>
				<?php
					if(!$con){
						echo '<div class="alert alert-info" role="alert">DB Connection failed! Use <b>admin/admin</b> to enter DB configuration mode!</div>';
					}
				?>
			</form>
		</div> <!-- /container -->
  </body>
</html>
