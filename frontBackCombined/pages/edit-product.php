<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 

        $product = ["image"=>"../image/product/no-product-found.png"];
        $hasProduct = false; 

        $productID = $_GET["productID"];
    } else {
        $productID = $_POST["productID"];
    }
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

        $sql = "SELECT * FROM category";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $categories = mysqli_fetch_all($result);
            }
        } else {
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
            <span class="title">EDIT PRODUCT</span>
        </div>

        <div class="form-container">
            <form action="edit-product.php?productID=<?php echo $productID ;?>" method="post"  enctype="multipart/form-data" id="addProductForm">

                <div class="backButton">
                    <a href="product-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Product Page</span>
                    </a>
                </div>
                
                <?php if ($productID): ?>
                
                <div class="product-img">
                    <div id="img-container">
                        <img src="<?php echo $product['image'];?>" onclick="triggerClick()" alt="">
                    </div>
                    <div class="img-uploader unshown" >
                        <label class="imgUploadLabel" for="productImgToUpload">
                            <i class="fa-solid fa-circle-plus"></i>
                            <input type="file" name="productImgToUpload" id="productImgToUpload" onchange="displayImage(this)" accept="image/*">
                        </label>
                        <div class="title">Add Product Image</div>
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
                            <input type="text" name="displayName" id="displayName" value="<?php echo $product['name'];?>" required>
                        </div>
                    </div>

                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" min="0" value="<?php echo $product['retailPrice'];?>" required>
                        </div>
                        <div class="form-item">
                            <label for="category">Category</label>
                            <select name="category" id="category" required>
                                <option value=""></option>
                                <?php foreach($categories as $category): ?>
                                    <option <?php if($product['category_ID'] == $category[0]){echo "selected";} ?> value="<?php echo $category[0];?>"><?php echo $category[1];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" value="<?php echo $product['description'];?>" required>
                        </div>
                    </div>

                    <div class="form-wrap">
                        <button class="edit" type="submit" name="submit">Edit</button>
                        <button type="reset" onclick="ResetInput()">Reset</button>
                    </div>
                </div>

                
                <?php else: ?>
                
                <div class="not-found-img-container">
                    <img src="<?php echo $product['image'];?>" alt="no-product-found">
                </div>

                <?php endif; ?>
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
        $c_grocery_name = mysqli_real_escape_string($conn, cleanInput($_POST['displayName']));
        $c_description = mysqli_real_escape_string($conn, cleanInput($_POST['description']));
        $c_price = mysqli_real_escape_string($conn, cleanInput($_POST['price']));
        $c_category_id = mysqli_real_escape_string($conn, cleanInput($_POST['category']));
        
        //process the image
        $file = $_FILES['productImgToUpload'];
        
        $fileName = $_FILES['productImgToUpload']['name'];
        $fileTmpName = $_FILES['productImgToUpload']['tmp_name'];
        $fileSize = $_FILES['productImgToUpload']['size'];
        $fileError = $_FILES['productImgToUpload']['error'];
        $fileType = $_FILES['productImgToUpload']['type'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg','jpeg','png');

        if (empty($fileName)) {
            $fileDestination = $product['image'];
        }

        if (in_array($fileActualExt,$allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 500000) {
                    unlink($product['image']);
                    $fileNameNew = $productID.".".$fileActualExt;
                    $fileDestination = '../image/product/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    // echo "Successfully uploaded the image!";
                } 
            } else {
                // echo "There was an error uploading your file!";
            }
        } else {
            // echo "You cannot upload files of this type!";
        }

        //Add to database
        $sql = "UPDATE product
        SET 
            image = '$fileDestination',
            name = '$c_grocery_name', 
            description = '$c_description', 
            retailPrice = '$c_price', 
            category_ID = '$c_category_id'
        WHERE id = '$productID'";

        if (mysqli_query($conn,$sql)) {
            $_SESSION['productID'] = $productID;
            echo '<script>window.location.href = "edit-product-success.php"; </script>';
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
