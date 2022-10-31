<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
		echo "<script>window.location = 'index.php';</script>"; 
		//header("Location: catlist.php");
	} else {
		$id = $_GET['pageid'];
	}
?>
<style> 
.acdel{
	margin-left: 10px;
}
.acdel a{
	background: #f0f0f0 none repeat scroll 0 0;
	border: 1px solid #ddd;
	color: #444;
	cursor: pointer;
	font-size: 20px;
	font-weight: normal;
	padding: 4px 10px;
}
</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Pages</h2>
            <?php
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					$name  = mysqli_real_escape_string($db->link, $_POST['name']);
					$body   = mysqli_real_escape_string($db->link, $_POST['body']);
					
					
					if($name == "" || $body == ""){
						echo "<span class='error'>Field must not be empty !!</span>";
					} else{
						$query = "update tbl_page set name = '$name', body = '$body' where id = '$id' ";
						$pageupdate = $db->update($query);
						if($pageupdate){
							echo "<span class='success'>Pages Updated Successfully !!</span>";
						} else {
							echo "<span class='error'>Pages Not Updated  !!</span>";
						}
					}
				}
			?>	
				<div class="block">
				<?php
					$query = "select * from tbl_page where id='$id'";
					$pages = $db->select($query);
					if($pages){
						while($result = $pages->fetch_assoc()){
				?>
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name= "name" value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                     
                  
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body" ><?php echo $result['body'];?>"</textarea>
                            </td>
                        </tr>
						
						<tr>
                            <td></td>
                            <td>
								<?php if(session::get('userrole')!='1') { ?>
									<input type="submit" name="submit" Value="Update" />
									<span class="acdel"><a onclick="return confirm('Are you sure to DELETE??');" href="delpage.php?delpageid=<?php echo $result['id'];?>">Delete</a></span>
								<?php } ?>
                                
								
                            </td>
                        </tr>
                    </table>
                    </form>
					<?php } } ?>
                </div>
            </div>
        </div>
<!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
<!-- Load TinyMCE -->		
<?php include 'inc/footer.php';?>


