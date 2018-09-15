<?php
    if(isset($_POST['checkBoxArray'])){
        if(isset($_POST['bulk_options'])){
            $bulk_options = $_POST['bulk_options'];
            foreach ($_POST['checkBoxArray'] as $checkboxValue) {
                $post_id = $checkboxValue;
                // echo $checkboxValue;
                // echo $bulk_options;
                switch ($bulk_options) {
                    case 'publish':
                        $query = "UPDATE posts SET post_status = 'published' WHERE post_id = {$post_id}";
                        $query_result = mysqli_query($connection,$query);
                        if(!$query_result){
                            die("QUERY FAILED".mysqli_error($connection));
                        }
                        break;

                    case 'draft':
                        $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = {$post_id}";
                        $query_result = mysqli_query($connection,$query);
                        if(!$query_result){
                            die("QUERY FAILED".mysqli_error($connection));
                        }
                        break;
                    
                    case 'delete':
                        $query = "DELETE FROM posts WHERE post_id = {$post_id}";
                        $query_result = mysqli_query($connection,$query);
                        if(!$query_result){
                            die("QUERY FAILED".mysqli_error($connection));
                        }
                        break;
                    case 'clone':
                        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                        $query_result = mysqli_query($connection,$query);
                        if(!$query_result){
                            die("QUERY FAILED ").mysqli_query($connection);
                        }

                        $row = mysqli_fetch_assoc($query_result);

                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                        $post_image = $row['post_image'];
                        $post_date = $row['post_date'];

                        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
                        $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

                        $query_result = mysqli_query($connection,$query);

                        if(!$query_result){
                            die("QUERY FAILED ".mysqli_error($connection));
                        }
                        
                        $last_id = mysqli_insert_id($connection);
                        
                        //clone comments
                        $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                        $query_result = mysqli_query($connection,$query);
                        if(!$query_result){
                            die("QUERY FAILED ").mysqli_error($connection);
                        }
                        
                        $comment_post_id = $last_id;
                        while($row = mysqli_fetch_assoc($query_result)){
                            $comment_author = $row['comment_author'];
                            $comment_email = $row['comment_email'];
                            $comment_status = $row['comment_status'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                            
                            $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_status,comment_date,comment_content) ";
                            $query .= "VALUES({$comment_post_id},'{$comment_author}','{$comment_email}','{$comment_status}','{$comment_date}','$comment_content')";
                            
                            $query_result_comment = mysqli_query($connection,$query);
                            
                            if(!$query_result_comment){
                                die("QUERY FAILED ").mysqli_error($connection);
                            }
                        }
                        
                        break;
                    default:
                        # code...
                        break;
                }
            }
            header("Location: posts.php?source=view_all_posts");
        }
    }
?>


<form method="post" action="">
    <div class="container" >
        <div class="row">
            <div class="col-xs-4 col-lg-4" style="padding-left: 0px">
                <select name="bulk_options" class="form-control" style="width: 100%">
                    <option value="">Select Option</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                </select> 
            </div>
            <div class="col-xs-8 col-lg-4">
                <input type="submit" name="submit_bulk" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
            </div>
        </div>
    </div>


    <table class="table table-bordered table-hover" style="margin-top: 10px">
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                <th class="text-center">Id</th>
                <th class="text-center">Author</th>
                <th class="text-center">Title</th>
                <th class="text-center">Category</th>
                <th class="text-center">Status</th>
                <th class="text-center">Image</th>
                <th class="text-center">Tags</th>
                <th class="text-center">Comments</th>
                <th class="text-center">Date</th>
                <th class="text-center">View Count</th>
                <th class="text-center">View Post</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
        </thead>

        <tbody> 
            <?php
                $query = "SELECT * FROM posts ORDER BY post_id DESC";

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
                        $post_date = $row["post_date"];
                        $post_view_count = $row["post_view_count"];
                        // $post_content = $row["post_content"];

                        echo "<tr>";
                            echo "<td><input class='checkbox checkBoxes_post' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>";
                            echo "<td class='text-center'>{$post_id}</td>";
                            echo "<td class='text-center'>{$post_title}</td>";
                            echo "<td class='text-center'>{$post_author}</td>";
                            //get category title using category id
                            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";

                            $query_result_category = mysqli_query($connection,$query);

                            if(!$query_result_category){
                                $post_category_title = "NONE";
                            }else{
                                while($row = mysqli_fetch_assoc($query_result_category)){
                                    $post_category_title = $row['cat_title'];
                                }
                            }

                            echo "<td class='text-center'>{$post_category_title}</td>";
                            echo "<td class='text-center'>{$post_status}</td>";
                            echo "<td class='text-center'><img width='100px' src='../images/{$post_image}' alt='Image'></td>";
                            echo "<td class='text-center'>{$post_tags}</td>";
                            
                        
                        
                            //get comment count
                            $query = "SELECT COUNT(*) as count FROM comments WHERE comment_post_id = {$post_id}";
                            $query_result_comment = mysqli_query($connection,$query);
                            if(!$query_result_comment){
                                die("QUERY FAILED ".mysqli_error($connection));
                            }else{
                                $row = mysqli_fetch_assoc($query_result_comment);
                                $post_comment_count = $row["count"];
                            }
                            echo "<td align='center'>
                                    <a class='' href='comments.php?post_id={$post_id}'>{$post_comment_count}</a>
                                </td>";
                            echo "<td class='text-center'>{$post_date}</td>";
                            echo "<td class='text-center'>{$post_view_count}</td>";
                            echo "<td align='center'>
                                    <a class='btn btn-success' href='../post.php?post_id={$post_id}'>View Post</a>
                                </td>";
                            echo "<td align='center'>
                                    <a class='btn btn-primary' href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a>
                                </td>";
                            echo "<td align='center'>
                                    <a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this post'); \" href='posts.php?delete={$post_id}'>Delete</a>
                                </td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>

</form>
<?php
    if(isset($_GET['delete'])){
        $post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = " . $post_id;

        $query_result = mysqli_query($connection,$query); 

        if(!$query_result){
            die("QUERY FAILED".mysqli_error($connection));
        }else{
            header("Location: posts.php?source=view_all_post");
        }
    }
?>