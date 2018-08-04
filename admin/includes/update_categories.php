<form action="" method="post" >   <!-- NOTE that the redirect path is same  -->
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
        <?php
                $cat_id = $_GET['edit'];

                $query = "SELECT * FROM categories WHERE cat_id = " . $cat_id; 

                $query_result = mysqli_query($connection,$query);

                if(!$query_result){
                    echo "Error!!!! Could not edit the category ".mysqli_error($connection);
                }else{
                    while($row = mysqli_fetch_assoc($query_result)){
                        $cat_id = $row["cat_id"];
                        $cat_title = $row["cat_title"];
        ?>

        <input value = "<?php if(isset($cat_id)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title_edit">

        <?php
                    }
                }
        ?>

    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit_edit" value="Update Category">
    </div>                                
</form>

<!-- HANDLE UPDATE -->
<?php
    if(isset($_POST['submit_edit'])){
        // cat_id will be in this scope so no need to redeclare it
        $cat_title = $_POST['cat_title_edit'];
        
        //validation to check if it is empty
        if($cat_title == '' || empty($cat_title)){
            echo "<h3>This field should not be empty</h3>";
        }else{
            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id} ";

            $query_result = mysqli_query($connection,$query);

            if(!$query_result){
                die("QUERY FAILED ".mysqli_error($connection));
            }else{
                header("Location: categories.php");
            }
        }
    }
?>