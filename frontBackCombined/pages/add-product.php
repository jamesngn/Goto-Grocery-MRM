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
                        <div class="form-item">
                            <label for="category">Category</label>
                            <select name="category" id="category">
                                <option value=""></option>
                                <option value="phone">Phone</option>
                                <option value="laptop">Laptop</option>
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

if(isset($_POST["submit"])) {
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
            $fileNameNew = uniqid('',true).".".$fileActualExt;
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
}

?>