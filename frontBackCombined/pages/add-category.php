<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;

    <?php 
        include '../includes/dbAuthentication.inc';

        $conn = OpenConnection();

        //select the latest id
        $sql = "SELECT CategoryID FROM category ORDER BY CategoryID DESC LIMIT 1";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $array = mysqli_fetch_row($result);
                $categoryID = $array[0]+1;
            } else {
                $categoryID = 100000;
            }
        } else {
            echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        }

        $sql = "SELECT * FROM category";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $categories = mysqli_fetch_all($result);
            }
        } else {
            echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        }
    ?>

    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">ADD NEW Category</span>
        </div>

        <div class="form-container ">
            <form action="add-category.php" method="post"  id="addProductForm">

                <div class="backButton">
                    <a href="category-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Category Page</span>
                    </a>
                </div>

               
                        
                    
                    

                <div class="text-input-container">
                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="categoryID">Category ID</label>
                            <input type="text" name="categoryID" id="categoryID" value="<?php echo $categoryID; ?>" readonly>
                        </div>
                    </div> 
                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="Name">Name</label>
                            <input type="text" name="Name" id="Name" required>
                        </div>
                    </div>
                </div>
                   
                    
                    <div class="form-wrap">
                        <button class="add" type="submit" name="submit">Add</button>
                        <button type="reset" onclick="ResetInput()">Reset</button>
                    </div>
                </div>
            </form>
            
        </div>

    </section>

    <script src="../js/product.js"></script>    
    <script src="../js/sidebar.js"></script>       
</body>
</html>


<?php 

    function cleanInput($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        

        // the cleaned – "safe" – inputs ready to be added to the database
        $c_category_name = mysqli_real_escape_string($conn, cleanInput($_POST['Name']));
       
        
       
        //Add to database
        $sql = "INSERT INTO category (categoryID,Name)
        VALUES ('$categoryID','$c_category_name')";

        if (mysqli_query($conn,$sql)) {
            echo '<script>window.location.href = "add-category-success.php"; </script>';

        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
