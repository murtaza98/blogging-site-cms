<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<?php

    if(isset($_POST['submit'])){
        
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $body = $_POST["body"];
        
        if(!empty($email)&&!empty($subject)&&!empty($body)){
            $email = mysqli_real_escape_string($connection,$email);
            $subject = mysqli_real_escape_string($connection,$subject);
            $body = mysqli_real_escape_string($connection,$body);
        }
        
        
        
        
        
        
        
        
    

        
    }

?>
    
 
    
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-xs-12">
                <div class="form-wrap">
                <h1>Contact Us</h1>
                   <br>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email">Your Best Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="username">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="username">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="10" cols="50"></textarea>
                        </div>                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php";?>
