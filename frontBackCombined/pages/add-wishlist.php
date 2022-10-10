<?php 
    include '../includes/header.inc';
?>
<body>
    <?php include '../includes/sidebar.inc';?>;

    <?php 
        include '../includes/dbAuthentication.inc';

        $conn = OpenConnection();

        //select the latest id
        $sql = "SELECT wishlistid FROM wishlist ORDER BY wishlistid DESC LIMIT 1";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $array = mysqli_fetch_row($result);
                $wishlistid = $array[0]+1;
            } else {
                $wishlistid = 100000;
            }
        } else {
            echo nl2br ("\r\n SQL error: " . mysqli_error($conn));
        }

        $sql = "SELECT * FROM wishlist";
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
            <span class="title">ADD NEW Wishlist</span>
        </div>

        <div class="form-container ">
            <form action="add-wishlist.php" method="post"  id="addProductForm">

                <div class="backButton">
                    <a href="wishlist-table.php">
                        <i class="fa-solid fa-delete-left"></i>
                        <span>Wishlist Page</span>
                    </a>
                </div>

               
                        
                    
                    

                <div class="text-input-container">
                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="wishlistid">Wishlist ID</label>
                            <input type="text" name="wishlistid" id="wishlistid" value="<?php echo $wishlistid; ?>" readonly>
                        </div>
                    </div> 
                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="cust_id">Customer ID</label>
                            <input type="text" name="cust_id" id="cust_id" required>
                        </div>
                    </div>
                    <div class="form-wrap">
                        <div class="form-item description">
                            <label for="prod_id">Product ID</label>
                            <input type="text" name="prod_id" id="prod_id" required>
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
        $c_wishlist_customer_id = mysqli_real_escape_string($conn, cleanInput($_POST['cust_id']));
        $c_wishlist_product_id = mysqli_real_escape_string($conn, cleanInput($_POST['prod_id']));
        
       
        //Add to database
        $sql = "INSERT INTO wishlist (wishlistid,cust_id,prod_id)
        VALUES ('$wishlistid','$c_wishlist_customer_id','$c_wishlist_product_id')";

        if (mysqli_query($conn,$sql)) {
            echo '<script>window.location.href = "add-wishlist-success.php"; </script>';

        } else {
            echo nl2br ("\r\nSQL errror: " . mysqli_error($conn));
        }
        CloseConnection($conn);
    }
?>
