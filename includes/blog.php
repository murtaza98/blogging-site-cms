<?php

	$query_result = mysqli_query($connection,$query);

	if($query_result){
		$row_count = mysqli_num_rows($query_result);
		if($row_count > 0){

			while($row = mysqli_fetch_assoc($query_result)){
				$post_id = $row["post_id"];
				$post_title = $row["post_title"];
				$post_author = $row["post_author"];
				$post_timestamp = $row["post_date"];
				$post_image = $row["post_image"];
				$post_content = substr($row["post_content"], 0,100);
?>
				<h2>
				    <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
				</h2>
				<p class="lead">
				    by <a href="author_posts.php?post_author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
				</p>
				<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_timestamp ?> at 10:00 PM</p>
				<hr>
				<a href="post.php?post_id=<?php echo $post_id ?>">
					<img class="img-responsive" src="images/<?php echo $post_image ?>" alt="images/default.jpg">
				</a>
				<hr>
				<p><?php echo $post_content ?></p>
				<a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
				<hr>
<?php
			}
		}else{
			echo "<h2 class='text-center text-danger'><b>No Blogs Found!!!!</b></h2>";
		}
	}else{
		echo "<h3 text-color='#F00'>NO BLOGS FOUND</h3>";
	}
?>

