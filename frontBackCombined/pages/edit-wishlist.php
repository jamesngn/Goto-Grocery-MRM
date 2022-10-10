<?php 
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "GET") { 
        $wishlistid = $_GET["wishlistid"];
    } else {
        $wishlistid = $_POST["wishlistid"];
    }
   
   echo $wishlistid;
   
   if ($wishlistid) {
        include '../includes/dbAuthentication.inc';
        $conn = OpenConnection();

        $sql = "SELECT * FROM wishlist WHERE wishlistid = '$wishlistid'";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $wishlist = mysqli_fetch_assoc($result);
                            
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
            <span class="title">EDIT WISHLIST</span>
        </div>

        <div class="form-container">
            <form action="edit-wishlist.php?wishlistid=<?php echo $wishlistid;?>" method="post"  id="addProductForm">
                <div class="backButton">
                    <a href="wishlist-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Wishlist Page</span>
                    </a>
                </div>
                

                
                <div class="text-input-container">
                    <div>
                    <div class="form-wrap">
                        <div class="form-item">
                            <label for="wishlistid">Wishlist ID</label>
                            <input type="text" name="wishlistid" id="wishlistid" value="<?php echo $wishlist['wishlistid'];?>" readonly>
                        </div>   

                    </div>
                    <div>
                        <div class="form-item">
                            <label for="cust_id">Customer ID</label>
                            <input type="text" name="cust_id" id="cust_id" value="<?php echo $wishlist['cust_id'];?>" required>
                        </div>
                    </div>
                     <div>

                        <div class="form-item">
                            <label for="prod_id">Product ID</label>
                            <input type="text" name="prod_id" id="prod_id" value="<?php echo $wishlist['prod_id'];?>" required>
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
        
        $c_wishlist_customer_id = mysqli_real_escape_string($conn, cleanInput($_POST['cust_id']));
        $c_wishlist_product_id = mysqli_real_escape_string($conn, cleanInput($_POST['prod_id']));
    
        //Add to database
        $sql = "UPDATE wishlist
        SET cust_id = '$c_wishlist_customer_id',
            prod_id = '$c_wishlist_product_id'
        WHERE wishlistid = '$wishlistid'";

        if (mysqli_query($conn,$sql)) {
            $_SESSION['wishlistid'] = $wishlistid;
            echo "<script>sessionStorage.setItem('wishlistid',".$wishlistid.");</script>";
            echo '<script>window.location.href = "edit-wishlist-success.php"; </script>';
        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
