<?php include "includes/db.php" ?>

<?php include "includes/header.php" ?>

<?php
    if(!isset($_GET['post_author'])){
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
                    if(isset($_GET["post_author"])){
                        $post_author = $_GET["post_author"];
                        $query = "SELECT * FROM posts WHERE post_author = '{$post_author}'";

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
                                    by <a href="#"><?php echo "$post_author" ?></a>
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

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>