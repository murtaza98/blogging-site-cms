<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Author</th>
            <th class="text-center">Title</th>
            <th class="text-center">Category</th>
            <th class="text-center">Status</th>
            <th class="text-center">Image</th>
            <th class="text-center">Tags</th>
            <th class="text-center">Comments</th>
            <th class="text-center">Date</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
    </thead>

    <tbody> 
        <?php
            $query = "SELECT * FROM posts";

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
                    // $post_content = $row["post_content"];

                    echo "<tr>";
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
                        echo "<td class='text-center'>{$post_comment_count}</td>";
                        echo "<td class='text-center'>{$post_date}</td>";
                        echo "<td align='center'>
                                <a class='btn btn-primary' href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a>
                            </td>";
                        echo "<td align='center'>
                                <a class='btn btn-primary' href='posts.php?delete={$post_id}'>Delete</a>
                            </td>";
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>
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