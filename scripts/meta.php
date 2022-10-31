<?php
		if(isset($_GET['pageid'])){
			$pagetitleid = $_GET['pageid'];
			$query = "select * from tbl_page where id='$pagetitleid'";
			$page = $db->select($query);
			if($page){
				while($result = $page->fetch_assoc()){ ?>
				<title><?php echo $result['name']; ?> - <?php echo TITLE; ?></title>
		<?php } } } elseif(isset($_GET['id'])){
			$pageid = $_GET['id'];
			$query = "select * from tbl_post where id='$pageid'";
			$post = $db->select($query);
			if($post){
				while($result = $post->fetch_assoc()){ ?>
				<title><?php echo $result['title']; ?> - <?php echo TITLE; ?></title>
		<?php } } } else{ ?>
			<title><?php echo $fm->title(); ?> - <?php echo TITLE; ?></title>
		<?php } ?>	
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
<?php
	if(isset($_GET['id'])){
		$keyword = $_GET['id'];
		$query = "select * from tbl_post where id='$keyword'";
		$keyword = $db->select($query);
		if($keyword){
			while($result = $keyword->fetch_assoc()){ ?>
	<meta name="keywords" content="<?php echo $result['tags'];?>">
	<?php } } } else { ?>
		<meta name="keywords" content="<?php echo TAGS;?>">
	<?php } ?>
	<meta name="author" content="Delowar">