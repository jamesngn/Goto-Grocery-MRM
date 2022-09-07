<?php 
    include '../includes/dbAuthentication.inc';
    session_start();

    $category_id = $_SESSION['categoryID'];
    $conn = OpenConnection();
    
    $sql = "SELECT * FROM category WHERE categoryID = $category_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $category = mysqli_fetch_assoc($result);
    }  else {
        echo "\r\nSQL error: " . mysqli_error($conn);
    }
    CloseConnection($conn);
?>




<?php
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/menu.inc'?>
    <h2>Edit Category Page</h2>
    <form action="edit-category.php" method="post">
        <fieldset>
            <legend>Edit the Category</legend>
            <p>
                <label for="category-name">Category Name:</label>
                <input type="text" name="category-name" id="category-name" value = "<?php echo $category['name'];?>">
            </p>
           
            
            <button type="submit">Edit</button>
            <button type="reset">Reset</button>
        </fieldset>
    </form>

    <?php

        function cleanInput($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $conn = OpenConnection();

            $c_category_name = mysqli_real_escape_string($conn, cleanInput($_POST['category-name']));
            

            $sql = 
            "UPDATE category 
            SET 
                name = '$c_category_name',
                
            WHERE categoryID = $category_id";

            if (mysqli_query($conn, $sql)) {
                echo "\r\nRecord updated successfully";
                session_unset();
                session_destroy();
            } else {
                echo "\r\nError updating record: " . mysqli_error($conn);
            }

            CloseConnection($conn);
        }
    ?>
    
    <?php include '../includes/footer.inc'?>
</body>
</html>