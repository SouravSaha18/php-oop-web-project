<?php 
	include '../lib/session.php';
	session::checkSession();
?>

<?php include '../helpers/format.php';?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>

<?php 
	$db=new Database();
?>

<?php
	if(!isset($_GET['delpageid']) || $_GET['delpageid'] == NULL){
		echo "<script>window.location = 'index.php';</script>"; 
		//header("Location: postlist.php");
	} else {
		$pageid = $_GET['delpageid'];
		
		$delquery = "delete from tbl_page where id='$pageid'";
		$result = $db->delete($delquery);
		if($result){
			echo "<span class='success'>Pages Deleted Successfully !!</span>";
			echo "<script>window.location = 'index.php';</script>"; 
		} else {
			echo "<span class='error'>Pages Not Deleted  !!</span>";
			echo "<script>window.location = 'index.php';</script>"; 
		}
	}
?>