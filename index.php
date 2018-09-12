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
    
                    if(isset($_GET["page"])){
                        $current_page = $_GET["page"];
//                        echo "<h3 class = 'text-center'></u>Page {$current_page}</u></h3>";
                    }else{
                        $current_page = 1;
                    }
                    
                    $post_query_count = "SELECT COUNT(*) as count FROM posts WHERE post_status = 'published'";
                    $find_count = mysqli_query($connection,$post_query_count);
                    $row = mysqli_fetch_assoc($find_count);
                    
                    $total_post_count =  $row["count"];

                    $no_of_posts_on_one_page = 3;
                    
                    $total_pages = ceil($total_post_count / $no_of_posts_on_one_page);

                    $start_post = $current_page * $no_of_posts_on_one_page - $no_of_posts_on_one_page;

                    $end_post_count = $start_post + $no_of_posts_on_one_page;

                    
                    
                    
                    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT {$start_post},{$end_post_count}";
                    include "includes/blog.php" 
                ?>

                <!-- Pager -->
                <ul class="pager">
                   <?php
                        if($current_page!=1){
                            $older_page = $current_page - 1;
                            echo "<li class='previous'>
                                <a href='index.php?page={$older_page}'>&larr; Older</a>
                            </li>";
                        }
                    ?>
                    <?php
                        for($i = 1;$i<=$total_pages;$i++){
                            if($current_page == $i){
                                echo "&nbsp;<li><a style='background-color:#286090;color:#fff'; href='index.php?page={$i}'>{$i}</a></li>&nbsp;";
                            }else{
                                echo "&nbsp;<li><a href='index.php?page={$i}'>{$i}</a></li>&nbsp;";
                            }
                        }
                        
                        
                    ?>
                    <?php
                        if($current_page!=$total_pages){
                            $next_page = $current_page + 1;
                            echo "<li class='next'>
                                    <a href='index.php?page={$next_page}'>Newer &rarr;</a>
                                </li>";
                        }                  
                    ?>
                    
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>


<?php include "includes/footer.php"; ?>


