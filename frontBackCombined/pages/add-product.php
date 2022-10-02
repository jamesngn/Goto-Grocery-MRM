<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;

    <section class="home-section">
        <div class="top-bar">
            <i class="fas fa-solid fa-bars"></i>
            <span class="title">ADD NEW PRODUCT</span>
        </div>

        <div class="form-container">
            <form action="add-product.php" method="post"  enctype="multipart/form-data" id="addProductForm">

                <a class="backButton" href="read-product.php">
                    <i class="fa-solid fa-delete-left"></i>
                    <span>Product Page</span>
                </a>

                <div class="img-uploader">
                    <label class="imgUploadLabel" for="productImgToUpload">
                        <i class="fa-solid fa-circle-plus"></i>
                        <input type="file" name="productImgToUpload" id="productImgToUpload">
                    </label>
                    <div class="title">Add Product Image</div>
                </div>

                <div class="text-input-container">
                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="productID">Product ID</label>
                            <input type="text" name="productID" id="productID">
                        </div>
                        <div class="form-item">
                            <label for="displayName">Display Name</label>
                            <input type="text" name="displayName" id="displayName">
                        </div>
                    </div>

                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price">
                        </div>

                        <?php 
                            include '../includes/dbAuthentication.inc';

                            $conn = OpenConnection();

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
                        <div class="form-item">
                            <label for="category">Category</label>
                            <select name="category" id="category">
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
                        <button type="reset">Reset</button>
                    </div>
                </div>
            </form>
            
        </div>

    </section>

    <script src="../js/sidebar.js"></script>
    <script src="../js/dashboard.js"></script>        
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

        
        //select the latest id
        $sql = "SELECT id FROM product ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $productID = mysqli_fetch_row($result);
            }
        } else {
            echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        }

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
        $sql = "INSERT INTO product (name,description,retailPrice,category_ID)
        VALUES ('$c_grocery_name','$c_description','$c_price','$c_category_id')";

        if (mysqli_query($conn,$sql)) {
            
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
