<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;

    <?php 
        include '../includes/dbAuthentication.inc';

        $conn = OpenConnection();

        //select the latest id
        $sql = "SELECT id FROM product ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $array = mysqli_fetch_row($result);
                $productID = $array[0]+1;
            } else {
                $productID = 100000;
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
            <span class="title">ADD NEW PRODUCT</span>
        </div>

        <div class="form-container">
            <form action="add-product.php" method="post"  enctype="multipart/form-data" id="addProductForm">

                <a class="backButton" href="product-table.php">
                    <i class="fa-solid fa-delete-left"></i>
                    <span>Product Page</span>
                </a>

                <div class="product-img">
                    <div id="img-container">
                        
                    </div>
                    <div class="img-uploader" >
                        <label class="imgUploadLabel" for="productImgToUpload">
                            <i class="fa-solid fa-circle-plus"></i>
                            <input type="file" name="productImgToUpload" id="productImgToUpload" onchange="displayImage(this)" accept="image/*" required>
                        </label>
                        <div class="title">Add Product Image</div>
                    </div>
                </div>

                <div class="text-input-container">
                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="productID">Product ID</label>
                            <input type="text" name="productID" id="productID" value="<?php echo $productID; ?>" readonly>
                        </div>
                        <div class="form-item">
                            <label for="displayName">Display Name</label>
                            <input type="text" name="displayName" id="displayName" required>
                        </div>
                    </div>

                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" min="0" required>
                        </div>
                        <div class="form-item">
                            <label for="category">Category</label>
                            <select name="category" id="category" required>
                                <option value=""></option>
                                <?php foreach($categories as $category): ?>
                                    <option value="<?php echo $category[0];?>"><?php echo $category[1];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description">
                        </div>
                    </div>
                    
                    <div class="form-wrap">
                        <button type="submit" name="submit">Add</button>
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

        if (in_array($fileActualExt,$allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 500000) {
                    $fileNameNew = $productID.".".$fileActualExt;
                    $fileDestination = '../image/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    echo "Successfully uploaded the image!";
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }

        //Add to database
        $sql = "INSERT INTO product (image,name,description,retailPrice,category_ID)
        VALUES ('$fileDestination','$c_grocery_name','$c_description','$c_price','$c_category_id')";

        if (mysqli_query($conn,$sql)) {
            header("location: add-product-success.php");

        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
