<?php include "includes/db.php" ?>

<?php include "includes/header.php" ?>

<?php
    if(!isset($_GET['post_id'])){
        // TODO REDIRECT TO HOMEPAGE
        header("Location: ./index.php");
    }
?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php
                    if(isset($_GET["post_id"])){
                        $post_id = $_GET["post_id"];
                        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";

                        $query_result = mysqli_query($connection,$query);

                        if($query_result){
                            while($row = mysqli_fetch_assoc($query_result)){
                                $post_id = $row["post_id"];
                                $post_title = $row["post_title"];
                                $post_author = $row["post_author"];
                                $post_date = $row["post_date"];
                                $post_image = $row["post_image"];
                                $post_content = $row["post_content"];
                ?>

                                <!-- Title -->
                                <h1><?php echo "$post_title" ?></h1>

                                <!-- Author -->
                                <p class="lead">
                                    by <a href="author_posts.php?post_author=<?php echo $post_author ?>"><?php echo "$post_author" ?></a>
                                </p>

                                <hr>

                                <!-- Date/Time -->
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "$post_date" ?> at 9:00 PM</p>

                                <hr>
                                <?php

                                if(isset($_SESSION['user_role'])){
                                    if($_SESSION['user_role'] === 'admin'){
                                        if(isset($_GET['post_id'])){
                                            $post_id = $_GET['post_id'];
                                            echo "<a class='btn btn-primary' href='admin/posts.php?source=edit_post&post_id={$post_id}'>Edit Post</a>";
                                        }
                                        echo '<hr>';
                                    }
                                }else{
                                    // echo "no set";
                                }

                                ?>

                                <!-- Preview Image -->
                                <img class="img-responsive" src="images/<?php echo "$post_image" ?>" alt="images/default.jpg">

                                <hr>

                                <!-- Post Content -->
                                <p class="lead"><?php echo "$post_content" ?></p>

                                <hr>


                <?php
                            }
                        }
                    }
                ?>                

                <!-- Blog Comments -->
                <?php
                    if(isset($_POST['comment_submit'])){

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        $comment_status = "unapproved";

                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                            $comment_post_id = $_GET['post_id'];

                            $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_status,comment_date,comment_content) ";
                            $query .= "VALUES($comment_post_id,'{$comment_author}','{$comment_email}','{$comment_status}',now(),'{$comment_content}')";


                            $query_result = mysqli_query($connection,$query);

                            if(!$query_result){
                                die("FAILED ".mysqli_error($connection));
                            }

                            //UPDATE THE COMMENT COUNT IN POST TABLE
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$comment_post_id}";

                            $query_result = mysqli_query($connection,$query);

                            if(!$query_result){
                                die("FAILED ".mysqli_error($connection));
                            }else{
                                echo "Passed";
                            }
                        }else{
                            echo "<script>alert('Comment Fields cannot be empty')</script>";
                        }

                        

                    }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <br>
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="comment_submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <!-- BOOTSTRAP MEDIA CLASS IS USED FOR COMMENTS -->
                <!-- Comment -->

                <?php
                    $comment_post_id = $_GET['post_id'];
                    $comment_query = "SELECT * FROM comments WHERE comment_post_id = {$comment_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";

                    $comment_query_result = mysqli_query($connection,$comment_query);

                    if(!$comment_query_result){
                        echo "No Comments Found";
                    }else{
                        $row_count = mysqli_num_rows($comment_query_result);
                        if($row_count > 0){
                            while($row_comment = mysqli_fetch_assoc($comment_query_result)){
                                $comment_author = $row_comment['comment_author'];
                                $comment_date = $row_comment['comment_date'];
                                $comment_content = $row_comment['comment_content'];                        
                ?>

                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" width="64" height="64" src="images/comment_avatar.png" alt="images/comment_avatar.png">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $comment_author; ?>
                                            <small><?php echo $comment_date; ?> at 9:30 PM</small>
                                        </h4>
                                        <?php echo $comment_content ?>
                                    </div>
                                </div>

                <?php
                            }
                        }else{
                            echo "<h4 class='text-center'>No Comments yet!!! Be the first one to comment</h4>";
                        }
                    }

                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>