<?php include "includes/db.php" ?>

<?php include "includes/header.php" ?>

<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Blog Post -->
                <?php
                    if(isset($_GET['post_id'])){
                        $post_category_id = $_GET['post_id'];
                        $query = "SELECT * FROM posts WHERE post_category_id = {$post_category_id}";
                        include "includes/blog.php";
                    }else{
                        header("Location: index.php");
                    }
                    
                ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>


<?php include "includes/footer.php"; ?>


