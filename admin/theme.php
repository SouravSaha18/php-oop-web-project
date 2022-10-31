<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
 

  <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Select Theme</h2>
               <div class="block copyblock"> 
			   <?php
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					
					$theme = mysqli_real_escape_string($db->link, $_POST['theme']);
					
					$query = "update tbl_theme set theme = '$theme' where id = '1' ";
					$themeupdate = $db->update($query);
					if($themeupdate){
						echo "<span class='success'>Theme Updated Successfully !!</span>";
					} else {
						echo "<span class='error'>Theme Not Updated  !!</span>";
					}
					
				}
			   ?>
			<?php
				$query= "select * from tbl_theme where id='1'";
				$themes= $db->select($query);
				while($result= $themes->fetch_assoc()){
			?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input <?php if($result['theme']=='default'){ echo "checked";} ?> type="radio" name="theme" value="default"  /> Default
                            </td>
                        </tr>
						<tr>
                            <td>
                                <input <?php if($result['theme']=='green'){ echo "checked";} ?> type="radio" name="theme" value="green"  />Deep Green
                            </td>
                        </tr>
						<tr>
                            <td>
                                <input <?php if($result['theme']=='lightgreen'){ echo "checked";} ?> type="radio" name="theme" value="lightgreen"  />light Green
                            </td>
                        </tr>
						<tr>
                            <td>
                                <input <?php if($result['theme']=='red'){ echo "checked";} ?> type="radio" name="theme" value="red"  /> Red
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
				<?php } ?>
                </div>
            </div>
        </div>
 <?php include 'inc/footer.php';?> 
 
 
