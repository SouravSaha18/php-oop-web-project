<?php 
	include '../lib/session.php';
	session::init();
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
<title>Password recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$email= $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link, $email);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					echo "<span style='color:red;font-size:18px;'> Invaild Email Address !!..</span>";
				} else {
					$mailquery= "select * from tbl_user where email='$email' limit 1";
					$mailcheck = $db->select($mailquery);
					if($mailcheck!= false){
						while($value = $mailcheck->fetch_assoc()){
							$userid = $value['id'];
							$username = $value['username'];
						}
						$text = substr($email, 0, 3);
						$rand = rand(10000, 99999);
						$newpass = "$text$rand";
						$password = md5($newpass);
						$upquery = "update tbl_user set password='$password' where id='$userid'";
						$updated_rows = $db->update($upquery);
						
						$to = $email;
						$from = "sourav.cse6.bu@gmail.com";
						
						$headers = "From: $from\n";
						$headers =	'MIME-Version: 1.0' . "\r\n" ;
						$headers .=	'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$subject = "Your Password:";
						$message = "Your Username is ".$username." and Your new Password is ".$newpass." Please Visit the Website for Login";
						$sendmail = mail($to, $subject, $message, $headers);
						if($sendmail){
							echo "<span style='color:red;font-size:18px;'> Please check Your Email for new Password !!..</span>";
						} else {
							echo "<span style='color:red;font-size:18px;'> Email not Exist !!..</span>";
						}
						
					} else {
						echo "<span style='color:red;font-size:18px;'> Email not Exist !!..</span>";
					}
				}
			}
		?>
		<form action="" method="post">
			<h1>Password recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email..." required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="send mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div>
		<div class="button">
			<a href="#">Sourav Saha</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>