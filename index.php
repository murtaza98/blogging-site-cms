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
                    
                    $post_query_count = "SELECT COUNT(*) as count FROM posts WHERE post_status = 'published'";
                    $find_count = mysqli_query($connection,$post_query_count);
                    $row = mysqli_fetch_assoc($find_count);
                    
                    $total_post_count =  $row["count"];
                    
                    
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    include "includes/blog.php" 
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


