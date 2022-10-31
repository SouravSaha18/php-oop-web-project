<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
				<?php
					if(isset($_GET['deluser'])){
						$deluser = $_GET['deluser'];
						$query = "delete from tbl_user where id='$deluser'";
						$result = $db->delete($query);
						if($result){
							echo "<span class='success'>User Deleted Successfully !!</span>";
						} else {
							echo "<span class='error'>User Not Deleted  !!</span>";
						}
					}
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>User Name</th>
							<th>Email</th>
							<th>Details</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
					<?php 
					$query= "select * from tbl_user order by id desc";
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
							<td><?php echo $result['username']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->readmore($result['details'], 30); ?></td>
							<td>
								<?php 
									if($result['role']=='0')
										echo "admin";
									else if($result['role']=='1')
										echo "author";
									else if($result['role']=='2')
										echo "editor";
								?>
							</td>
							<td><a href="viewuser.php?vuser=<?php echo $result['id']?>">View</a> <?php if(session::get('userrole')== '0'){ ?> || <a onclick="return confirm('Are you sure to DELETE??');" href="?deluser=<?php echo $result['id']?>">Delete</a><?php } ?></td>
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


