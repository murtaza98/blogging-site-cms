<?php

	function insert_categories(){
		global $connection;
		if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];
            
            //validation to check if it is empty
            if($cat_title == '' || empty($cat_title)){
                echo "<h3>This field should not be empty</h3>";
            }else{
                $query = "INSERT INTO categories(cat_title) VALUES('$cat_title')";

                $query_result = mysqli_query($connection,$query);

                if(!$query_result){
                    die("QUERY FAILED ".mysqli_error($connection));
                }else{
                    header("Location: categories.php");
                }
            }
        }
	}

    function delete_categories(){
        global $connection;
        if(isset($_GET['delete'])){
            $cat_id = $_GET['delete'];

            $query = "DELETE FROM categories WHERE cat_id = " . $cat_id;

            $query_result = mysqli_query($connection,$query);

            if(!$query_result){
                echo "Error!!!! Could not delete the category ".mysqli_error($connection);
            }else{
                header("Location: ./categories.php");
            }
        }
    }

    function findAllCategories(){
        global $connection;
        $query = "SELECT * FROM categories LIMIT 12";

        $query_result = mysqli_query($connection,$query);

        if($query_result){
            while($row = mysqli_fetch_assoc($query_result)){
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "<tr>
                        <td class = 'center-row'>{$cat_id}</td>
                        <td>{$cat_title}</td>
                        <td align='center'>
                            <a class='btn btn-primary' href='categories.php?delete={$cat_id}'>Delete</a>
                        </td>
                        <td align='center'>
                            <a class='btn btn-primary' href='categories.php?edit={$cat_id}'>Edit</a>
                        </td>
                    </tr>";
            }
        }else{
            echo "<li class='warning'>Error!!!! NO CATEGORIES FOUND</li>";
        }
    }
?>