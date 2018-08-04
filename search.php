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

                <!-- Searched Blog Post -->

                <?php 
                    if(isset($_POST["submit"])){

                        $search = $_POST["search"];
                        if(!strlen($search)==0){
                            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";

                            $search_result = mysqli_query($connection,$query);

                            if(!$search_result){
                                die("QUERY FAILED " . mysqli_error( ));
                            }else{
                                $count = mysqli_num_rows($search_result);

                                if($count == 0){
                                    echo "<h1> NO RESULT </h1>";
                                }else{
                                    echo "<h3>Result Found " . $count ."</h3>";
                                    while($row = mysqli_fetch_assoc($search_result)){
                                        $post_title = $row["post_title"];
                                        $post_author = $row["post_author"];
                                        $post_timestamp = $row["post_date"];
                                        $post_image = $row["post_image"];
                                        $post_content = $row["post_content"];

                ?>
                                        <h2>
                                            <a href="#"><?php echo $post_title ?></a>
                                        </h2>
                                        <p class="lead">
                                            by <a href="index.php"><?php echo $post_author ?></a>
                                        </p>
                                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_timestamp ?> at 10:00 PM</p>
                                        <hr>
                                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                                        <hr>
                                        <p><?php echo $post_content ?></p>
                                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                        <hr>
                <?php
                                    }
                                }
                            }
                        }else{
                            echo "Type something to search";
                        }
                    }else{
                        //Redirect to index.php page
                ?> 
                    <meta http-equiv="refresh" content="0; URL='index.php'"/> 
                <?php 
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


