<?php
	//handle update button clicked 
	if(isset($_POST['update_user'])){
		$user_id = $_GET['user_id'];
		$username = $_POST['username'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$user_role = $_POST['user_role'];

		//hanle image upload
		$profile_image = $_FILES['profile_image']['name'];
		$profile_image_temp_location = $_FILES['profile_image']['tmp_name'];
		$profile_image_error_code = $_FILES['profile_image']['error'];
		//TODO CHECK FOR VALID EXTENTIONS FOR IMAGES
		if($profile_image_error_code === 0 && !empty($profile_image)){
			move_uploaded_file($profile_image_temp_location,"../images/$profile_image");
		}else{
			//To handle the condition when the image is not selected during update
			if(empty($profile_image)){
				$user_id = $_GET['user_id'];
				$query_image = "SELECT * FROM users WHERE user_id = {$user_id}";

				$query_result = mysqli_query($connection,$query_image);

				if(!$query_result){
					$profile_image = "default_user.png";
				}else{
					while($row = mysqli_fetch_assoc($query_result)){
						$profile_image = $row['user_image'];
					}
				}
			}else{
				//EXTREME CASE
				$profile_image = "default_user.png";
			}
		}

		//encrypt password
		$query = "SELECT randSalt FROM users";

        $select_randSalt_query = mysqli_query($connection,$query);

        if(!$select_randSalt_query){
            die("QUERY FAILED ".mysqli_error($connection));
        }else{
            while($row = mysqli_fetch_assoc($select_randSalt_query)){
                $randSalt = $row['randSalt'];
                break;
            }
            $encrypted_password = crypt($password,$randSalt);
        }

		//Update database
		$query = "UPDATE users SET ";
		$query .= "username = '{$username}', ";
		$query .= "password = '{$encrypted_password}', ";
		$query .= "first_name = '{$first_name}', ";
		$query .= "last_name = '{$last_name}', ";
		$query .= "user_email = '{$email}', ";
		$query .= "user_role = '{$user_role}', ";
		$query .= "user_image = '{$profile_image}' ";
		$query .= "WHERE user_id = {$user_id}"; 

		$query_result = mysqli_query($connection,$query);

		if($query_result){
			echo "<h3 class='bg-success text-center'>User added&nbsp;&nbsp;&nbsp;
					<a href='users.php?source=view_all_users'>View All Users</a>
				</h3>";
		}else{
			die("QUERY FAILED " . mysqli_error($connection));
		}

	}

	//
	if(isset($_GET['user_id'])){
		$user_id = $_GET['user_id'];

		$query = "SELECT * FROM users WHERE user_id = {$user_id}";

		$query_result = mysqli_query($connection,$query);

		if(!$query_result){
			die("QUERY FAILED ".mysqli_error($connection));
		}else{
			while($row = mysqli_fetch_assoc($query_result)){
				$username = $row['username'];
				$password = $row['password'];
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$user_email = $row['user_email'];
				$user_image = $row['user_image'];
				$user_role = $row['user_role'];
			}
		}
	}
?>

<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username" value="<?php echo $username  ?>">		
	</div>

	<div class="form-group">
		<label for="firstname">First Name</label>
		<input type="text" class="form-control" name="first_name" value="<?php echo $first_name  ?>">		
	</div>

	<div class="form-group">
		<label for="lastname">Last Name</label>
		<input type="text" class="form-control" name="last_name" value="<?php echo $last_name  ?>">		
	</div>

	<div class="form-group">
		<label for="image">Profile Image</label>
		<input type="file" class="form-control" name="profile_image">		
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="email" value="<?php echo $user_email  ?>">		
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" value="<?php echo $password  ?>">		
	</div>

	<div class="form-group">
		<label for="role">Role</label>
		<select name="user_role" class=" form-control selectpicker show-tick" style="width: 30%">
			<option value="subscriber">Select Option</option>
			<option <?php if($user_role=='subscriber'){echo 'selected';} ?> value="subscriber">Subscriber</option>
			<option <?php if($user_role=='admin'){echo 'selected';} ?> value="admin">Admin</option>
		</select>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_user" value="Update Changes">		
	</div>
	
</form>