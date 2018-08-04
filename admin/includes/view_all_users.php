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
            <th class="text-center">Approve</th>
            <th class="text-center">Unapprove</th>
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
                    $role = $row["role"];
                    $date = $row["date"];

                    echo "<tr>";
                        echo "<td class='text-center'>{$user_id}</td>";
                        echo "<td class='text-center'>{$username}</td>";
                        echo "<td class='text-center'>{$firstname}</td>";
                        echo "<td class='text-center'>{$lastname}</td>";
                        echo "<td class='text-center'>{$user_email}</td>";
                        echo "<td class='text-center'>{$role}</td>";
                        echo "<td class='text-center'>{$date}</td>";
                        echo "<td align='center'>
                                <a class='btn btn-success' href=''>Approve</a>
                            </td>";
                        echo "<td align='center'>
                                <a class='btn btn-warning' href=''>Unapprove</a>
                            </td>";
                        echo "<td align='center'>
                                <a class='btn btn-danger' href=''>Delete</a>
                            </td>";
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>
<?php
    if(isset($_GET['delete'])){
        $comment_id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id = " . $comment_id;

        $query_result = mysqli_query($connection,$query); 

        if(!$query_result){
            die("QUERY FAILED".mysqli_error($connection));
        }else{
            header("Location: comments.php");
        }
    }
?>
<!-- unapprove comment -->
<?php
    if(isset($_GET['unapprove'])){
        $comment_id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$comment_id}";
        echo "$query";

        $query_result = mysqli_query($connection,$query); 

        if(!$query_result){
            die("QUERY FAILED".mysqli_error($connection));
        }else{
            header("Location: comments.php");
        }
    }
?>
<!-- approve comment -->
<?php
    if(isset($_GET['approve'])){
        $comment_id = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment_id}";

        $query_result = mysqli_query($connection,$query); 

        if(!$query_result){
            die("QUERY FAILED".mysqli_error($connection));
        }else{
            header("Location: comments.php");
        }
    }
?>