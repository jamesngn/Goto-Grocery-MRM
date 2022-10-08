<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 

       

        $categoryID = $_GET["CategoryID"];
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
            <span class="title">READ CATEGORY</span>
        </div>

        <div class="form-container">
            <div id="addProductForm">

                <div class="backButton">
                    <a href="category-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Category Page</span>
                    </a>
                </div>
                
                
                
                <div class="text-input-container">
                   
                        <div class="form-item">
                            <label for="categoryID">Category ID</label>
                            <input type="text" name="categoryID" id="categoryID" value="<?php echo $category['CategoryID'];?>" readonly>
                        </div>
                        <div class="form-item">
                            <label for="Name">Name</label>
                            <input type="text" name="Name" id="Name" value="<?php echo $category['Name'];?>" readonly>
                        </div>
                   

                    

                    

               
            </div>
        </div>

    </section>
    
    <script src="../js/sidebar.js"></script>    
</body>
</html>