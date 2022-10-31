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
	if(!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL){
		echo "<script>window.location = 'sliderlist.php';</script>"; 
		//header("Location: postlist.php");
	} else {
		$sliderid = $_GET['sliderid'];
		
		$query = "select * from tbl_slider where id='$sliderid'";
		$post= $db->select($query);
		if($post)
		{
			while($delimg = $post->fetch_assoc()){
				$dellink = $delimg['image'];
				unlink($dellink);
			}
		}
		
		$delquery = "delete from tbl_slider where id='$sliderid'";
		$result = $db->delete($delquery);
		if($result){
			echo "<span class='success'>Category Deleted Successfully !!</span>";
			echo "<script>window.location = 'sliderlist.php';</script>"; 
		} else {
			echo "<span class='error'>Category Not Deleted  !!</span>";
			echo "<script>window.location = 'sliderlist.php';</script>"; 
		}
	}
?>