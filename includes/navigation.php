<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">BLOG SITE</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $query = "SELECT * FROM categories";

                        $query_result = mysqli_query($connection,$query);

                        if($query_result){
                            while($row = mysqli_fetch_assoc($query_result)){
                                $cat_title=strtoupper($row['cat_title']);
                                echo "<li>
                                        <a href='#'>{$cat_title}</a>
                                    </li>";
                            }
                        }else{
                            die("QUERY FAILED ". mysqli_error($connection));
                        }
                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                  <li><a href="admin"><span class="glyphicon glyphicon-log-in"></span> Admin</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>