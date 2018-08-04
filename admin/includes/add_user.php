<?php
	if(isset($_POST['add_user'])){
		$username = $_POST['username'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$user_role = $_POST['user_role'];

		$query = "INSERT INTO ";


		// $post_image = $_FILES['post_image']['name'];
		// $post_image_temp_location = $_FILES['post_image']['tmp_name'];
		// $post_image_error_code = $_FILES['post_image']['error'];

		// //TODO CHECK FOR VALID EXTENTIONS FOR IMAGES

		// if($post_image_error_code === 0){
		// 	move_uploaded_file($post_image_temp_location,"../images/$post_image");

		// 	$query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
		// 	$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}')";

		// 	$query_result = mysqli_query($connection,$query);

		// 	if($query_result){
		// 		echo "<h4 class='bg-success text-center'>Post added</h4>";
		// 	}else{
		// 		die("QUERY FAILED " . mysqli_error($connection));
		// 	}


		// }else{
		// 	echo "<h4>Error uploading the image</h4>";
		// }
	}
?>

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username">		
	</div>

	<div class="form-group">
		<label for="firstname">First Name</label>
		<input type="text" class="form-control" name="first_name">		
	</div>

	<div class="form-group">
		<label for="lastname">Last Name</label>
		<input type="text" class="form-control" name="last_name">		
	</div>

	<!-- <div class="form-group">
		<label for="image">Post Image</label>
		<input type="file" class="form-control" name="post_image">		
	</div> -->

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="email">		
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password">		
	</div>

	<div class="form-group">
		<label for="role">Role</label>
		<select name="user_role" class=" form-control selectpicker show-tick" style="width: 30%">
			<option value="subscriber">Subscriber</option>
			<option value="admin">Admin</option>
		</select>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="add_user" value="Add User">		
	</div>
	
</form>