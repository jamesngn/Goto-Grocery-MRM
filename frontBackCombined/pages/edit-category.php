<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 
        $categoryID = $_GET["categoryID"];
    } else {
        $categoryID = $_POST["categoryID"];
    }
   
   echo $categoryID;
   
   if ($categoryID) {
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "SELECT * FROM category WHERE CategoryID = '$categoryID'";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $category = mysqli_fetch_assoc($result);
                            
            }
        }
        else {
            echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        }

       

    }
?>

<?php 
    include '../includes/header.inc';
    
?>
<body>
    <?php include '../includes/sidebar.inc';?>;
    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">EDIT CATEGORY</span>
        </div>

        <div class="form-container">
            <form action="edit-category.php?categoryID=<?php echo $categoryID;?>" method="post"  id="addProductForm">
                <div class="backButton">
                    <a href="category-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Category Page</span>
                    </a>
                </div>
                

                
                <div class="text-input-container">
                    <div>
                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="CategoryID">Category ID</label>
                            <input type="text" name="categoryID" id="CategoryID" value="<?php echo $category['CategoryID'];?>" readonly>
                        </div>    
                    </div>

                        <div class="form-item">
                            <label for="Name">Category Name</label>
                            <input type="text" name="Name" id="Name" value="<?php echo $category['Name'];?>" required>
                        </div>
                    </div>

                  

                    

                    <div class="form-wrap">
                        <button class="edit" type="submit" name="submit">Edit</button>
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
        $sql = "UPDATE category
        SET name = '$c_category_name'
        WHERE CategoryID = '$categoryID'";

        if (mysqli_query($conn,$sql)) {
            $_SESSION['categoryID'] = $categoryID;
            echo "<script>sessionStorage.setItem('categoryID',".$categoryID.");</script>";
            echo '<script>window.location.href = "edit-category-success.php"; </script>';
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
