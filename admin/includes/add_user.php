<?php
	if(isset($_POST['add_user'])){
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
			$profile_image = "default_user.png";
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

		$query = "INSERT INTO users(username,password,first_name,last_name,user_email,user_role,join_date,user_image) ";
		$query .= "VALUES('$username','$encrypted_password','$first_name','$last_name','$email','$user_role',now(),'$profile_image')";

		$query_result = mysqli_query($connection,$query);

		if(!$query_result){
			die("QUERY FAILED ".mysqli_error($connection));
		}else{
			echo "<h4 class='bg-success text-center'>User added&nbsp;&nbsp;&nbsp;
					<a href='users.php?source=view_all_users'>View All Users</a>
				</h4>";
		}
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

	<div class="form-group">
		<label for="image">Profile Image</label>
		<input type="file" class="form-control" name="profile_image">		
	</div>

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
			<option value="subscriber">Select Option</option>
			<option value="subscriber">Subscriber</option>
			<option value="admin">Admin</option>
		</select>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="add_user" value="Add User">		
	</div>
	
</form>