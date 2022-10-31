<?php 
	include '../lib/session.php';
	Session::checklogin() ;
?>

<?php include '../helpers/format.php';?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php 
	$db=new Database();
	$fm=new format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$username= $fm->validation($_POST['username']);
				$password= $fm->validation(md5($_POST['password']));
			
				$username = mysqli_real_escape_string($db->link, $username);
				$password = mysqli_real_escape_string($db->link, $password);
				
				$query = "select * from tbl_user where username='$username' and password='$password'";
				$result = $db->select($query);
				if($result!= false){
					$value = $result->fetch_assoc();
						session::set("login", true);
						session::set("username", $value['username']);
						session::set("userid", $value['id']);
						session::set("userrole", $value['role']);
						echo "<script>window.location = 'index.php';</script>"; 
					
				} else {
					echo "<span style='color:red;font-size:18px;'> Username or password Invalid !!..</span>";
				}
			}
		?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgetpass.php">Forget Password !!</a>
		</div>
		<div class="button">
			<a href="#">Sourav Saha</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>