<?php
	if(isset($_POST['create_post'])){
		$post_title = $_POST['post_title'];
		$post_category_id = $_POST['post_category_id'];
		$post_author = $_POST['post_author'];
		$post_status = $_POST['post_status'];
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];

		$post_comment_count = 0;

		$post_image = $_FILES['post_image']['name'];
		$post_image_temp_location = $_FILES['post_image']['tmp_name'];
		$post_image_error_code = $_FILES['post_image']['error'];

		//TODO CHECK FOR VALID EXTENTIONS FOR IMAGES

		if($post_image_error_code === 0){
			move_uploaded_file($post_image_temp_location,"../images/$post_image");

			$query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
			$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}',{$post_comment_count},'{$post_status}')";

			$query_result = mysqli_query($connection,$query);

			if($query_result){
				echo "<h4 class='bg-success text-center'>Post added</h4>";
			}else{
				die("QUERY FAILED " . mysqli_error($connection));
			}


		}else{
			echo "<h4>Error uploading the image</h4>";
		}
	}
?>

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="post_title">		
	</div>

	<div class="form-group">
		<select name = 'post_category_id' id='post_category'>
		<?php
            $cat_id = $post_category_id;

            $query = "SELECT * FROM categories"; 

            $query_result = mysqli_query($connection,$query);

            if(!$query_result){
                echo "Error!!!! Could not load categories ".mysqli_error($connection);
            }else{
                while($row = mysqli_fetch_assoc($query_result)){
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
		?>
		</select>	
	</div>

	<div class="form-group">
		<label for="title">Post Author</label>
		<input type="text" class="form-control" name="post_author">		
	</div>

	<div class="form-group">
		<label for="title">Post Status</label>
		<input type="text" class="form-control" name="post_status">		
	</div>

	<div class="form-group">
		<label for="title">Post Image</label>
		<input type="file" class="form-control" name="post_image">		
	</div>

	<div class="form-group">
		<label for="title">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">		
	</div>

	<div class="form-group">
		<label for="title">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>		
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">		
	</div>
	
</form>