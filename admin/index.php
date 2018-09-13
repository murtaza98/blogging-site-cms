<?php include "includes/admin_header.php" ?>
    
    <div id="wrapper">
       
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->



                <!-- /.row -->
                <?php
                    //total post count
                    $query = "SELECT * FROM posts";
                    $query_result = mysqli_query($connection,$query);
                    if(!$query_result){
                        die("QUERY FAILED ".mysqli_error($connection));
                        $num_posts = 0;
                    }else{
                        $num_posts = mysqli_num_rows($query_result);
                    }

                    //total post comments
                    $query = "SELECT * FROM comments";
                    $query_result = mysqli_query($connection,$query);
                    if(!$query_result){
                        die("QUERY FAILED ".mysqli_error($connection));
                        $num_comments = 0;
                    }else{
                        $num_comments = mysqli_num_rows($query_result);
                    }

                    //total number of users
                    $query = "SELECT * FROM users";
                    $query_result = mysqli_query($connection,$query);
                    if(!$query_result){
                        die("QUERY FAILED ".mysqli_error($connection));
                        $num_users = 0;
                    }else{
                        $num_users = mysqli_num_rows($query_result);
                    }

                    //total post count
                    $query = "SELECT * FROM categories";
                    $query_result = mysqli_query($connection,$query);
                    if(!$query_result){
                        die("QUERY FAILED ".mysqli_error($connection));
                        $num_categories = 0;
                    }else{
                        $num_categories = mysqli_num_rows($query_result);
                    }

                ?>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $num_posts ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php?source=view_all_posts">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'><?php echo $num_comments ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php?source=view_all_comments">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $num_users ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php?source=view_all_users">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $num_categories ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                    //total draft post count
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $query_result = mysqli_query($connection,$query);
                    if(!$query_result){
                        die("QUERY FAILED ".mysqli_error($connection));
                        $num_posts_draft = 0;
                    }else{
                        $num_posts_draft = mysqli_num_rows($query_result);
                    }

                    //total unappreoved comments
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                    $query_result = mysqli_query($connection,$query);
                    if(!$query_result){
                        die("QUERY FAILED ".mysqli_error($connection));
                        $num_comments_unapproved = 0;
                    }else{
                        $num_comments_unapproved = mysqli_num_rows($query_result);
                    }

                    //total number of users who are subscriber
                    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $query_result = mysqli_query($connection,$query);
                    if(!$query_result){
                        die("QUERY FAILED ".mysqli_error($connection));
                        $num_users_subs = 0;
                    }else{
                        $num_users_subs = mysqli_num_rows($query_result);
                    }

                ?>

                <div class="row">
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Date', 'Count'],

                          <?php
                            
                            $element_text = ['All Posts','Active Posts','Draft Post','Categories','Users','Subscriber','Comments','Unapproved Comments'];
                            //note that since here there are only 2 kinds of posts status, I have simple subtracted the draft post to active post inorder to get the published(i.e active) posts.
                            $element_count = [$num_posts,$num_posts-$num_posts_draft,$num_posts_draft,$num_categories,$num_users,$num_users_subs,$num_comments,$num_comments_unapproved];

                            for($i=0;$i<sizeof($element_text);$i++){
                                // this loop generates this kind of output
                                // ['2014', 1000],
                                echo "['{$element_text[$i]}',{$element_count[$i]}],";
                            }

                          ?>

                        ]);

                        var options = {
                          chart: {
                            title: 'Website Performance',
                            subtitle: 'Posts, Categories, Users and Comments : 2018-2019',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                    
                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>
