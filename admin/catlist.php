﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
				<?php
					if(isset($_GET['delcat'])){
						$delid = $_GET['delcat'];
						$query = "delete from tbl_category where id='$delid'";
						$result = $db->delete($query);
						if($result){
							echo "<span class='success'>Category Deleted Successfully !!</span>";
						} else {
							echo "<span class='error'>Category Not Deleted  !!</span>";
						}
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
					<?php 
					$query= "select * from tbl_category order by id desc";
					$category= $db->select($query);
					if($category)
					{
						$i=0;
						while($result= $category->fetch_assoc()){
							$i++;
					?>
					
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<?php if(session::get('userrole')!='1') { ?>
								<td><a href="editcat.php?edcat=<?php echo $result['id']?>">Edit</a> || <a onclick="return confirm('Are you sure to DELETE??');" href="?delcat=<?php echo $result['id']?>">Delete</a></td>
							<?php } else { ?>
								<td><?php echo "You have no right  !"; ?></td>
							<?php } ?>
						</tr>
					<?php } } ?>		
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
$(document).ready(function () {
     setupLeftMenu();
		$('.datatable').dataTable();
			setSidebarHeight();
		});
</script>
<?php include 'inc/footer.php';?>  


