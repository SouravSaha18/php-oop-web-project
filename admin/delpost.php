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
	if(!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL){
		echo "<script>window.location = 'postlist.php';</script>"; 
		//header("Location: postlist.php");
	} else {
		$postid = $_GET['delpostid'];
		
		$query = "select * from tbl_post where id='$postid'";
		$post= $db->select($query);
		if($post)
		{
			while($delimg = $post->fetch_assoc()){
				$dellink = $delimg['image'];
				unlink($dellink);
			}
		}
		
		$delquery = "delete from tbl_post where id='$postid'";
		$result = $db->delete($delquery);
		if($result){
			echo "<span class='success'>Category Deleted Successfully !!</span>";
			echo "<script>window.location = 'postlist.php';</script>"; 
		} else {
			echo "<span class='error'>Category Not Deleted  !!</span>";
			echo "<script>window.location = 'postlist.php';</script>"; 
		}
	}
?>