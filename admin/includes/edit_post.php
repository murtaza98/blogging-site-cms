<form action="" method="post" enctype="multipart/form-data">

	<?php
		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];

			$query = "SELECT * FROM posts WHERE post_id = " . $post_id;

			$query_result = mysqli_query($connection,$query);

	        if($query_result){
	            while($row = mysqli_fetch_assoc($query_result)){
	                $post_id = $row["post_id"];
	                $post_title = $row["post_title"];
	                $post_author = $row["post_author"];
	                $post_category_id = $row["post_category_id"];
	                $post_status = $row["post_status"];
	                $post_image = $row["post_image"];
	                $post_tags = $row["post_tags"];
	                $post_comment_count =$row["post_comment_count"];
	                $post_date = $row["post_date"];
	                $post_content = $row["post_content"];
	            }
	        }

	        if(isset($_POST['update_post'])){
	        	$post_title = $_POST['post_title'];
				$post_category_id = $_POST['post_category_id'];
				$post_author = $_POST['post_author'];
				$post_status = $_POST['post_status'];
				$post_tags = $_POST['post_tags'];
				$post_content = $_POST['post_content'];

				$post_image = $_FILES['post_image']['name'];
				$post_image_temp_location = $_FILES['post_image']['tmp_name'];
				$post_image_error_code = $_FILES['post_image']['error'];

				//To handle the condition when the image is not selected
				if(empty($post_image)){
					$no_image_uploaded = "true";
					//goto database and get the saved image
					$query = "SELECT * FROM posts WHERE post_id = " . $post_id;

					$query_result = mysqli_query($connection,$query);

					if(!$query_result){
						$post_image = "default.jpg";
					}else{
						while($row = mysqli_fetch_assoc($query_result)){
							$post_image = $row['post_image'];
						}
					}
				}


				//TODO CHECK FOR VALID EXTENTIONS FOR IMAGES

				if($post_image_error_code === 0||$no_image_uploaded == "true"){
					move_uploaded_file($post_image_temp_location,"../images/$post_image");

					$query = "UPDATE posts SET ";
					$query .= "post_title = '{$post_title}', ";
					$query .= "post_author = '{$post_author}', ";
					$query .= "post_status = '{$post_status}', ";
					$query .= "post_category_id = '{$post_category_id}', ";
					$query .= "post_tags = '{$post_tags}', ";
					$query .= "post_content = '{$post_content}', ";
					$query .= "post_image = '{$post_image}', ";
					$query .= "post_date = now() ";
					$query .= "WHERE post_id = {$post_id}"; 

					$query_result = mysqli_query($connection,$query);

					if($query_result){
						echo "<h3 class='bg-success text-center'>Post Updated &nbsp;
								 <a href='../post.php?post_id={$post_id}'>View Post</a>
									or 
								<a href = 'posts.php?source=view_all_posts'>Edit More Posts</a>
							</h3>";
					}else{
						die("QUERY FAILED " . mysqli_error($connection));
					}


				}else{
					echo "<h4>Error uploading the image</h4>";
				}
	        }
		}
    ?>

	<div class="form-group">
		<label for="title">Post Title</label>
		<input value="<?php echo $post_title ?>" type="text" class="form-control" name="post_title">		
	</div>

	<div class="form-group">
		<label for="category">Post Category</label>
		<select name = 'post_category_id' id='post_category' class=" form-control selectpicker show-tick" style="width: 30%">

		<?php
            $selected_cat_id = $post_category_id;

            $query = "SELECT * FROM categories"; 

            $query_result = mysqli_query($connection,$query);

            if(!$query_result){
                echo "Error!!!! Could not load categories ".mysqli_error($connection);
            }else{
                while($row = mysqli_fetch_assoc($query_result)){
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];
                    if($cat_id == $selected_cat_id){
                    	echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
                    }else{
                    	echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }
            }
		?>

		</select>	
	</div>

	<div class="form-group">
		<label for="title">Post Author</label>
		
		<select name = 'post_author' id='post_author' class="form-control selectpicker show-tick" style="width: 30%">
		<?php
            $query = "SELECT user_id,username FROM users WHERE user_role = 'admin'"; 

            $query_result = mysqli_query($connection,$query);

            if(!$query_result){
                echo "Error!!!! Could not load categories ".mysqli_error($connection);
            }else{
                while($row = mysqli_fetch_assoc($query_result)){
                    $user_id = $row["user_id"];
                    $username = $row["username"];
                    
                    if($post_author === $username){
                        echo "<option value='{$username}' selected>{$username}</option>";
                    }else{
                        echo "<option value='{$username}'>{$username}</option>";
                    }
                }
            }
		?>
		</select>
		
		
<!--		<input value="<?php //echo $post_author; ?>" type="text" class="form-control" name="post_author">		-->
	</div>

	<div class="form-group">
		<label for="title">Post Status</label>
		<select name="post_status" class=" form-control selectpicker show-tick" style="width: 30%">
			<option value="draft" <?php if($post_status == 'draft'){echo "selected";} ?> >Draft</option>
			<option value="published" <?php if($post_status == 'published'){echo "selected";}  ?> >Published</option>
		</select>	
	</div>

	<div class="form-group">
		<label for="title">Post Image</label>
		<div class="row">
			<div class="col-xs-8">
				<input type="file" class="form-control" name="post_image">	
			</div>
			<div class="col-xs-4">
				<img width="200px" src="../images/<?php echo $post_image;?>" alt="Image">
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="title">Post Tags</label>
		<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">		
	</div>

	<div class="form-group">
		<label for="title">Post Content</label>
		<textarea  class="form-control" name="post_content" id="editor" cols="30" rows="10"><?php echo $post_content; ?>
		</textarea>		
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">		
	</div>
	
</form>