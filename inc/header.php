<?php include 'helpers/format.php';?>
<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>

<?php 
	$db=new Database();
	$fm=new format();
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'scripts/meta.php'; ?>
	<?php include 'scripts/css.php'; ?>
	<?php include 'scripts/js.php'; ?>
	
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
			<?php
				$query = "select * from title_slogan where id='1'";
				$btitle = $db->select($query);
				if($btitle){
					while($result = $btitle->fetch_assoc()){
			?>
				<img src="admin/<?php echo $result['logo'];?>" alt="Logo"/>
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['slogan'];?></p>
			<?php } } ?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php
					$query = "select * from tbl_social where id='1'";
					$tsocial = $db->select($query);
					if($tsocial){
						while($result = $tsocial->fetch_assoc()){
				?>
					<a href="<?php echo $result['fb'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
					<a href="<?php echo $result['tw'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="<?php echo $result['ln'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
					<a href="<?php echo $result['gp'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
<?php
	$path = $_SERVER['SCRIPT_FILENAME'];
	$cpage = basename($path, '.php');
?>
	<ul>
		<li><a <?php if($cpage == 'index'){ echo 'id="active"';}?> 
		href="index.php">Home</a></li>
		<?php
			$query = "select * from tbl_page";
			$pages = $db->select($query);
			if($pages){
				while($result = $pages->fetch_assoc()){
		?>
		<li><a 
		<?php
		if(isset($_GET['pageid']) && $_GET['pageid']==$result['id']){
			echo 'id="active"';
		}
			?>
		
		href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['name'];?></a></li>
		<?php } } ?>	
		<li><a <?php if($cpage == "contact"){echo 'id="active"';}?> href="contact.php">Contact</a></li>
	</ul>
</div>