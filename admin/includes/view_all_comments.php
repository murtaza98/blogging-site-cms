<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Author</th>
            <th class="text-center">Comment</th>
            <th class="text-center">Email</th>
            <th class="text-center">Status</th>
            <th class="text-center">In Response to</th>
            <th class="text-center">Date</th>
            <th class="text-center">Approve</th>
            <th class="text-center">Unapprove</th>
            <th class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody> 
        <?php
            if(isset($_GET["post_id"])){
                $post_id = $_GET["post_id"];
                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ORDER BY comment_id DESC";
            }else{
                $query = "SELECT * FROM comments ORDER BY comment_id DESC";
            }
            

            $query_result = mysqli_query($connection,$query);

            if($query_result){
                while($row = mysqli_fetch_assoc($query_result)){
                    $comment_id = $row["comment_id"];
                    $comment_post_id = $row["comment_post_id"];
                    $comment_author = $row["comment_author"];
                    $comment_email = $row["comment_email"];
                    $comment_status = $row["comment_status"];
                    $comment_date = $row["comment_date"];
                    $comment_content = $row["comment_content"];

                    //In response to field will contain the post title
                    $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";

                    $select_post_id_query = mysqli_query($connection,$query);

                    while($row_select = mysqli_fetch_assoc($select_post_id_query)){
                        $post_title = $row_select['post_title'];
                    }

                    echo "<tr>";
                        echo "<td class='text-center'>{$comment_id}</td>";
                        echo "<td class='text-center'>{$comment_author}</td>";
                        echo "<td class='text-center'>{$comment_content}</td>";

                        echo "<td class='text-center'>{$comment_email}</td>";
                        echo "<td class='text-center'>{$comment_status}</td>";
                        echo "<td class='text-center'>
                                <a href='../post.php?post_id={$comment_post_id}'>{$post_title}</a>
                            </td>";
                        echo "<td class='text-center'>{$comment_date}</td>";
                        echo "<td align='center'>
                                <a class='btn btn-success' href='comments.php?approve={$comment_id}'>Approve</a>
                            </td>";
                        echo "<td align='center'>
                                <a class='btn btn-warning' href='comments.php?unapprove={$comment_id}'>Unapprove</a>
                            </td>";
                        echo "<td align='center'>
                                <a class='btn btn-danger' href='comments.php?delete={$comment_id}'>Delete</a>
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