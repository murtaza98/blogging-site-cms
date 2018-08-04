<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Username</th>
            <th class="text-center">Firstname</th>
            <th class="text-center">Lastname</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Date</th>
            <th class="text-center">Change to Admin</th>
            <th class="text-center">Change to Subscriber</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody> 
        <?php
            $query = "SELECT * FROM users ORDER BY user_id DESC";

            $query_result = mysqli_query($connection,$query);

            if($query_result){
                while($row = mysqli_fetch_assoc($query_result)){
                    $user_id = $row["user_id"];
                    $username = $row["username"];
                    $firstname = $row["first_name"];
                    $lastname = $row["last_name"];
                    $user_email = $row["user_email"];
                    $role = $row["user_role"];
                    $date = $row["join_date"];

                    echo "<tr>";
                        echo "<td class='text-center'>{$user_id}</td>";
                        echo "<td class='text-center'>{$username}</td>";
                        echo "<td class='text-center'>{$firstname}</td>";
                        echo "<td class='text-center'>{$lastname}</td>";
                        echo "<td class='text-center'>{$user_email}</td>";
                        echo "<td class='text-center'>{$role}</td>";
                        echo "<td class='text-center'>{$date}</td>";
                        echo "<td align='center'>
                                <a class='btn btn-success' href='users.php?source=view_all_users&change_to_admin={$user_id}'>Admin</a>
                            </td>";
                        echo "<td align='center'>
                                <a class='btn btn-success' href='users.php?source=view_all_users&change_to_subscriber={$user_id}'>Subscriber</a>
                            </td>";
                        echo "<td align='center'>
                                <a class='btn btn-warning' href='users.php?source=edit_user&user_id={$user_id}'>Edit</a>
                            </td>";
                        echo "<td align='center'>
                                <a class='btn btn-danger' href='users.php?source=view_all_users&delete={$user_id}'>Delete</a>
                            </td>";
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>
<?php
    if(isset($_GET['delete'])){
        $user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = " . $user_id;

        $query_result = mysqli_query($connection,$query); 

        if(!$query_result){
            die("QUERY FAILED".mysqli_error($connection));
        }else{
            header("Location: users.php?source=view_all_users");
        }
    }
?>
<!-- unapprove comment -->
<?php
    if(isset($_GET['change_to_admin'])){
        $user_id = $_GET['change_to_admin'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id}";
        echo "$query";

        $query_result = mysqli_query($connection,$query); 

        if(!$query_result){
            die("QUERY FAILED".mysqli_error($connection));
        }else{
            header("Location: users.php?source=view_all_users");
        }
    }
?>
<!-- approve comment -->
<?php
    if(isset($_GET['change_to_subscriber'])){
        $user_id = $_GET['change_to_subscriber'];

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id}";

        $query_result = mysqli_query($connection,$query); 

        if(!$query_result){
            die("QUERY FAILED".mysqli_error($connection));
        }else{
            header("Location: users.php?source=view_all_users");
        }
    }
?>