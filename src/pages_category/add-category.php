<?php include '../includes/header.inc'; ?>
<body>
    <?php include '../includes/menu.inc'; ?>
    <h2>Add Categories</h2>

    <form method="post" action="add-category.php">
        <fieldset>
            <legend>Enter new category details</legend>
            <p>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required />
            </p>
            <p>
                <label for="category-id">Category ID:</label>
                <input type="text" name="category-id" id="category-id">
            </p>
            <p>
            <input type="submit" value="Submit">
            <input type="reset"> 
            </p>
            
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

    include '../includes/dbAuthentication.inc';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $conn = OpenConnection();

        // the cleaned – "safe" – inputs ready to be added to the database
        $c_name = mysqli_real_escape_string($conn, cleanInput($_POST['name']));  
        $c_category_id = mysqli_real_escape_string($conn, cleanInput($_POST['category-id']));
        

        //Add to database
        $sql = "INSERT INTO category (name,category_ID)
        VALUES ('$c_name','$c_category_id')";

        if (mysqli_query($conn,$sql)) {
            echo nl2br ("\r\n Added $c_name category to the database");
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
<?php include '../includes/footer.inc'; ?>
    </body>
</html>
