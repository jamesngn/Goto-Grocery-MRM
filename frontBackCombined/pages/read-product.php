<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 

        $product = ["image"=>"../image/product/no-product-found.png"];
        $hasProduct = false; 

        $productID = $_GET["productID"];
        if ($productID) {
            include '../includes/dbAuthentication.inc';
            $conn = OpenConnection();
    
            $sql = "SELECT * FROM product WHERE id = '$productID'";
            $result = mysqli_query($conn,$sql);
    
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $product = mysqli_fetch_assoc($result);   
                    $hasProduct = true;             
                }
            }
            else {
                echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
            }
    
            if ($hasProduct) {
                $currCategoryID = $product['category_ID'];
                $sql = "SELECT Name FROM category WHERE CategoryID = '$currCategoryID'";
                $result = mysqli_query($conn,$sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $categoryName = mysqli_fetch_row($result)[0];                
                    }
                }
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
            <span class="title">READ PRODUCT</span>
        </div>

        <div class="form-container">
            <div id="addProductForm">

                <div class="backButton">
                    <a href="product-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Product Page</span>
                    </a>
                </div>
                
                <?php if ($hasProduct): ?>
                <div class="product-img">
                    <div id="img-container">
                        <img src="<?php echo $product['image'];?>" alt="">
                    </div>
                </div>
                
                <div class="text-input-container">
                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="productID">Product ID</label>
                            <input type="text" name="productID" id="productID" value="<?php echo $product['id'];?>" readonly>
                        </div>
                        <div class="form-item">
                            <label for="displayName">Display Name</label>
                            <input type="text" name="displayName" id="displayName" value="<?php echo $product['name'];?>" readonly>
                        </div>
                    </div>

                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" min="0" value="<?php echo $product['retailPrice'];?>" readonly>
                        </div>
                        <div class="form-item">
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category"  value="<?php echo $categoryName;?>" readonly>
                        </div>
                    </div>

                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" value="<?php echo $product['description'];?>" readonly>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                
                <div class="not-found-img-container">
                    <img src="<?php echo $product['image'];?>" alt="no-product-found">
                </div>

                <?php endif; ?>
            </div>
        </div>

    </section>
    
    <script src="../js/sidebar.js"></script>    
</body>
</html>