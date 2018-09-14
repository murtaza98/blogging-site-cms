<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		//to prevent sql injection
		$username = mysqli_real_escape_string($connection,$username);
		$password = mysqli_real_escape_string($connection,$password);

		$query = "SELECT * FROM users WHERE username = '{$username}'";

		$query_result = mysqli_query($connection,$query);

		if(!$query_result){
			die("QUERY FAILED ".mysqli_error($connection));
		}else{
			$row_count = mysqli_num_rows($query_result);
			if($row_count==1){
				while ($row = mysqli_fetch_assoc($query_result)) {
					$db_user_id = $row['user_id'];
					$db_username = $row['username'];
					$db_password = $row['password'];
					$db_user_role = $row['user_role'];
					$db_first_name = $row['first_name'];
					$db_last_name = $row['last_name'];

					//decrypt password

					echo "{$password} <br>    {$db_password} <br>";


					$decrypt_password = crypt($password,$db_password);

					echo $decrypt_password;
				}
			}else if($row_count > 1){
				echo "<h3 class='text-center'><b>Duplicate username found,Please contact the site admin</b></h3>";
			}
            
            
            if(password_verify($password,$db_password)){
                //SUCCESS
				//update session
				$_SESSION['user_id'] = $db_user_id;
				$_SESSION['username'] = $db_username;
				$_SESSION['first_name'] = $db_first_name;
				$_SESSION['last_name'] = $db_last_name;
				$_SESSION['user_role'] = $db_user_role;

				header("Location: ../admin");
            }else{
                //wrong password
				header("Location: ../index.php");
            }


            //old way
//			if($username === $db_username && $db_password === $decrypt_password){
//				//SUCCESS
//				//update session
//				$_SESSION['user_id'] = $db_user_id;
//				$_SESSION['username'] = $db_username;
//				$_SESSION['first_name'] = $db_first_name;
//				$_SESSION['last_name'] = $db_last_name;
//				$_SESSION['user_role'] = $db_user_role;
//
//				header("Location: ../admin");
//			}else{
//				//wrong password
//				header("Location: ../index.php");
//			}
		}
	}

?>